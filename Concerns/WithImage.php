<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class Image
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithImage
{
    /** @var int */
    protected int $minWidth = 0;

    /** @var int */
    protected int $minHeight = 0;

    /** @var int */
    protected int $maxWidth = 0;

    /** @var int */
    protected int $maxHeight = 0;

    /**
     * @param int $value
     * @return static
     */
    public function minWidth(int $value): static
    {
        $this->minWidth = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return static
     */
    public function maxWidth(int $value): static
    {
        $this->maxWidth = $value;

        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @return static
     */
    public function width(int $min, int $max = 0): static
    {
        return $this->minWidth( $min )->maxWidth( $max );
    }

    /**
     * @param int $value
     * @return static
     */
    public function minHeight(int $value): static
    {
        $this->minHeight = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return static
     */
    public function maxHeight(int $value): static
    {
        $this->maxHeight = $value;

        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @return static
     */
    public function height(int $min, int $max = 0): static
    {
        return $this->minHeight( $min )->maxHeight( $max );
    }
}