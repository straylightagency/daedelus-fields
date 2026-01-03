<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithMultiple;
use Daedelus\Fields\Concerns\WithNullable;
use Daedelus\Fields\Fields;
use Daedelus\Support\Filters;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class PostObject extends AbstractField
{
    use WithNullable, WithMultiple;

    /** @var array */
    protected array $postsTypes = [];

    /** @var array */
    protected array $taxonomies = [];

    /** @var string */
    protected string $format = 'object';

    /**
     * @param array $taxonomies
     * @return static
     */
    public function taxonomies(array $taxonomies): PostObject
    {
        $this->taxonomies = array_values( $taxonomies );

        return $this;
    }

    /**
     * @param array $posts_types
     * @return static
     */
    public function postsType(array $posts_types): PostObject
    {
        $this->postsTypes = array_values( $posts_types );

        return $this;
    }

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): PostObject
    {
        if ( in_array( $value, ['object', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function returnObject(): PostObject
    {
        return $this->return('object');
    }

    /**
     * @return static
     */
    public function returnId(): PostObject
    {
        return $this->return('id');
    }

    /**
     * @param callable $callback
     * @return static
     */
    public function onQuery(callable $callback): AbstractField
    {
        Filters::add('acf/fields/post_object/query/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @param callable $callback
     * @return static
     */
    public function onResult(callable $callback): AbstractField
    {
        Filters::add('acf/fields/post_object/result/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::postObject, [
            'post_type' => !empty( $this->postsTypes ) ? $this->postsTypes : '',
            'taxonomy' => !empty( $this->taxonomies ) ? $this->taxonomies : '',
            'allow_null' => (int) $this->nullable,
            'multiple' => (int) $this->multiple,
            'return_format' => $this->format,
        ] );
    }
}