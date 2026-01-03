<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithNullable;
use Daedelus\Fields\Fields;
use Daedelus\Support\Filters;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Taxonomy extends AbstractField
{
    use WithNullable;

    /** @var string */
    protected string $taxonomy = 'category';

    /** @var string */
    protected string $appearance = 'checkbox';

    /** @var bool */
    protected bool $saveTerms = false;

    /** @var string */
    protected string $format = 'id';

    /** @var bool */
    protected bool $allowAddTerm = true;

    /**
     * @param string $value
     * @return static
     */
    public function which(string $value): Taxonomy
    {
        $this->taxonomy = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return static
     */
    public function appearance(string $value): Taxonomy
    {
        if ( in_array( $value, ['checkbox', 'multi_select', 'radio', 'select'] ) ) {
            $this->appearance = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function asCheckbox(): Taxonomy
    {
        return $this->appearance('checkbox');
    }

    /**
     * @return static
     */
    public function asMultiSelect(): Taxonomy
    {
        return $this->appearance('multi_select');
    }

    /**
     * @return static
     */
    public function asRadio(): Taxonomy
    {
        return $this->appearance('radio');
    }

    /**
     * @return $this
     */
    public function asSelect(): Taxonomy
    {
        return $this->appearance('select');
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function saveTerms(bool $value = true): Taxonomy
    {
        $this->saveTerms = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function dontSaveTerms(): Taxonomy
    {
        return $this->saveTerms( false );
    }

    /**
     * @param string $value
     * @return $this
     */
    public function return(string $value): Taxonomy
    {
        if ( in_array( $value, ['object', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function returnObject(): Taxonomy
    {
        return $this->return('object');
    }

    /**
     * @return $this
     */
    public function returnId(): Taxonomy
    {
        return $this->return('id');
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function allowAddTerm(bool $value = true): Taxonomy
    {
        $this->allowAddTerm = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function disallowAddTerm(): Taxonomy
    {
        return $this->allowAddTerm( false );
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onQuery(callable $callback): AbstractField
    {
        Filters::add('acf/fields/taxonomy/query/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function onResult(callable $callback): AbstractField
    {
        Filters::add('acf/fields/taxonomy/result/key=' . $this->key, $callback, 10, 3 );

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::taxonomy, [
            'taxonomy' => $this->taxonomy,
            'field_type' => $this->appearance,
            'allow_null' => (int) $this->nullable,
            'load_save_terms' => (int) $this->saveTerms,
            'return_format' => $this->format,
            'add_term' => (int) $this->allowAddTerm,
        ] );
    }
}