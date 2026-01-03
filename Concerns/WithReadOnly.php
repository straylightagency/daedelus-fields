<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class CanBeReadOnly
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithReadOnly
{
    /** @var bool */
    protected bool $readOnly = false;

    /**
     * @param bool $value
     * @return static
     */
    public function isReadOnly(bool $value = true): static
    {
        $this->readOnly = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function notReadOnly(): static
    {
        return $this->isReadOnly( false );
    }
}