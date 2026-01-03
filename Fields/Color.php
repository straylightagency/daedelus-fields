<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Color extends AbstractField
{
    /** @var bool */
    protected bool $enableOpacity = false;

        /** @var string */
    protected string $format = 'string';

    /**
     * @param bool $value
     * @return static
     */
    public function enableOpacity(bool $value = true): Color
    {
        $this->enableOpacity = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function disableOpacity(): Color
    {
        return $this->enableOpacity( false );
    }

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): Color
    {
        if ( in_array( $value, ['array', 'string'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function returnArray(): Color
    {
        return $this->return('array');
    }

    /**
     * @return static
     */
    public function returnString(): Color
    {
        return $this->return('string');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::color, [
            'enable_opacity' => (int) $this->enableOpacity,
            'return_format' => $this->format,
        ] );
    }
}