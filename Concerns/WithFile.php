<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class File
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithFile
{
    /** @var int */
    protected int $minSize = 0;

    /** @var int */
    protected int $maxSize = 0;

    /** @var array */
    protected array $mimeTypes = [];

    /**
     * @param ...$mime_types
     *
     * @return static
     */
    public function mimeTypes(...$mime_types): static
    {
        $this->mimeTypes = $mime_types;

        return $this;
    }

    /**
     * @param int $value
     * @param string $unit
     *
     * @return static
     */
    public function minSize(int $value, string $unit = 'MB'): static
    {
        $this->minSize = $value . trim( $unit );

        return $this;
    }

    /**
     * @param int $value
     * @param string $unit
     *
     * @return static
     */
    public function maxSize(int $value, string $unit = 'MB'): static
    {
        $this->maxSize = $value . trim( $unit );

        return $this;
    }

    /**
     * @param int $min
     * @param int $max
     * @param string $unit
     *
     * @return static
     */
    public function size(int $min, int $max = 0, string $unit = 'MB'): static
    {
        if ( is_string( $max ) ) {
            $unit = $max;
            $max = 0;
        }

        return $this->minSize( $min, $unit )->maxSize( $max, $unit );
    }
}