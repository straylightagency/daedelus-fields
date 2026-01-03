<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithChoices
{
    /** @var array */
    protected array $choices = [];

    /**
     * @param array $choices
     *
     * @return static
     */
    public function choices(array $choices): static
    {
        $this->choices = $choices;

        return $this;
    }
}