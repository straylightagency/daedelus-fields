<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithMinMax;
use Daedelus\Fields\Fields;
use Daedelus\Support\Filters;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Relationship extends AbstractField
{
    use WithMinMax;

    /** @var array */
    protected array $postsTypes = [];

    /** @var array */
    protected array $taxonomies = [];

    /** @var string[] */
    protected array $filters = [
        'search',
        'post_type',
        'taxonomy'
    ];

    /** @var string */
    protected string $format = 'object';

    /**
     * @param array $taxonomies
     * @return static
     */
    public function taxonomies(array $taxonomies): Relationship
    {
        $this->taxonomies = $taxonomies;

        return $this;
    }

    /**
     * @param array $posts_type
     * @return static
     */
    public function postsType(array $posts_type): Relationship
    {
        $this->postsTypes = $posts_type;

        return $this;
    }

    /**
     * @param array $values
     * @return static
     */
    public function filters(array $values): Relationship
    {
        foreach ( $values as $key => $value ) {
            if ( in_array( $key, ['search', 'post_type', 'taxonomy'] ) && is_bool( $value ) ) {
                $this->filters[ $key ] = $value;
            }
        }

        return $this;
    }

    /**
     * @param bool $value
     * @return static
     */
    public function filterOnSearch(bool $value = true): Relationship
    {
        $this->filters( ['search' => $value ] );

        return $this;
    }

    /**
     * @return static
     */
    public function dontFilterOnSearch(): Relationship
    {
        return $this->filterOnSearch( false );
    }

    /**
     * @param bool $value
     * @return static
     */
    public function filterByPostType(bool $value = true): Relationship
    {
        $this->filters( ['post_type' => $value ] );

        return $this;
    }

    /**
     * @return static
     */
    public function dontFilterByPostType(): Relationship
    {
        return $this->filterByPostType( false );
    }

    /**
     * @param bool $value
     * @return static
     */
    public function filterByTaxonomy(bool $value = true): Relationship
    {
        $this->filters( ['taxonomy' => $value ] );

        return $this;
    }

    /**
     * @return static
     */
    public function dontFilterByTaxonomy(): Relationship
    {
        return $this->filterByTaxonomy( false );
    }

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): Relationship
    {
        if ( in_array( $value, ['object', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function returnObject(): Relationship
    {
        return $this->return('object');
    }

    /**
     * @return static
     */
    public function returnId(): Relationship
    {
        return $this->return('id');
    }

    /**
     * @param callable $callback
     * @return static
     */
    public function onQuery(callable $callback): AbstractField
    {
        Filters::add('acf/fields/relationship/query/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @param callable $callback
     * @return static
     */
    public function onResult(callable $callback): AbstractField
    {
        Filters::add('acf/fields/relationship/result/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::relationship, [
            'post_type' => !empty( $this->postsTypes ) ? $this->postsTypes : '',
            'taxonomy' => !empty( $this->taxonomies ) ? $this->taxonomies : '',
            'filters' => array_keys( $this->filters ),
            'min' => $this->min,
            'max' => $this->max,
            'return_format' => $this->format,
        ] );
    }
}