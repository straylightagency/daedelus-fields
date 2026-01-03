<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithButton
{
    /** @var string */
    protected string $button = 'Add row';

    /**
     * Define the label of a button
     *
     * @param string $label
     *
     * @return static
     */
    public function button(string $label): static
    {
        $this->button = $label;

        return $this;
    }
}