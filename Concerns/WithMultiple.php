<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class Multiple
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithMultiple
{
    /** @var bool */
    protected bool $multiple = false;

    /**
     * @param bool $value
     *
     * @return static
     */
    public function multiple(bool $value = true): static
    {
        $this->multiple = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function notMultiple(): static
    {
        return $this->multiple( false );
    }
}