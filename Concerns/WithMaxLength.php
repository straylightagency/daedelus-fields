<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithMaxLength
{
    /** @var int */
    protected int $maxLength = 0;

    /**
     * @param int $limit
     *
     * @return static
     */
    public function maxLength(int $limit): static
    {
        $this->maxLength = $limit;

        return $this;
    }
}