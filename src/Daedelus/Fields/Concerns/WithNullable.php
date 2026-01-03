<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class Nullable
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithNullable
{
    /** @var bool */
    protected bool $nullable = false;

    /**
     * @param bool $value
     *
     * @return static
     */
    public function nullable(bool $value = true): static
    {
        $this->nullable = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function notNullable(): static
    {
        return $this->nullable( false );
    }
}