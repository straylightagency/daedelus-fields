<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Link extends AbstractField
{
    /** @var string */
    protected string $format = 'array';

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): Link
    {
        if ( in_array( $value, ['array', 'url'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function returnArray(): Link
    {
        return $this->return('array');
    }

    /**
     * @return static
     */
    public function returnUrl(): Link
    {
        return $this->return('url');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::link, [
            'return_format' => $this->format,
        ] );
    }
}