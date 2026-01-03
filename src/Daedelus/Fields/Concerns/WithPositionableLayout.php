<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class Position
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithPositionableLayout
{
    /** @var string */
    protected string $layout = 'vertical';

    /**
     * @param string $value
     *
     * @return static
     */
    public function layout(string $value): static
    {
        if ( in_array( $value, ['horizontal', 'vertical'] ) ) {
            $this->layout = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function vertical(): static
    {
        return $this->layout( 'vertical' );
    }

    /**
     * @return static
     */
    public function horizontal(): static
    {
        return $this->layout( 'horizontal' );
    }
}