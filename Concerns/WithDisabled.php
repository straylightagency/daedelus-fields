<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithDisabled
{
    /** @var bool */
    protected bool $disabled = false;

    /**
     * @param bool $value
     *
     * @return static
     */
    public function disable(bool $value = true): static
    {
        $this->disabled = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function enable(): static
    {
        return $this->disable( false );
    }
}