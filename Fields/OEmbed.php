<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class OEmbed extends AbstractField
{
    /** @var int */
    protected int $width = 0;

    /** @var int */
    protected int $height = 0;

    /**
     * @param int $width
     * @return static
     */
    public function width(int $width): OEmbed
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param int $height
     * @return static
     */
    public function height(int $height): OEmbed
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     * @return static
     */
    public function dimension(int $width, int $height): OEmbed
    {
        return $this->width( $width )->height( $height );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::oembed, [
            'width' => $this->width > 0 ? $this->width : '',
            'height' => $this->height > 0 ? $this->height : '',
        ] );
    }
}