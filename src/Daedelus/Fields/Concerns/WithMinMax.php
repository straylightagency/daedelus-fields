<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class MinMax
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithMinMax
{
    /** @var int */
    protected int $min = 0;

    /** @var int */
    protected int $max = 0;

    /**
     * @param int $value
     *
	 * @return static
     */
    public function min(int $value): static
    {
        $this->min = $value;

        return $this;
    }

    /**
     * @param int $value
     *
	 * @return static
     */
    public function max(int $value): static
    {
        $this->max = $value;

        return $this;
    }
}