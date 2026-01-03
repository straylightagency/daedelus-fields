<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithLayout
{
    /** @var string */
    protected string $layout = 'block';

    /**
     * @param string $value
     *
	 * @return static
     */
    public function layout(string $value): static
    {
        if ( in_array( $value, [ 'block', 'table', 'row' ] ) ) {
            $this->layout = $value;
        }

        return $this;
    }

    /**
	 * @return static
     */
    public function blockLayout(): static
    {
        return $this->layout( 'block' );
    }

    /**
	 * @return static
     */
    public function tableLayout(): static
    {
        return $this->layout( 'table' );
    }

    /**
	 * @return static
     */
    public function rowLayout(): static
    {
        return $this->layout( 'row' );
    }
}