<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Time extends AbstractField
{
    /** @var string */
    protected string $displayFormat = 'g:i a';

    /** @var string  */
    protected string $returnFormat = 'g:i a';

    /**
     * @param string $value
     * @return static
     */
    public function display(string $value): Time
    {
        $this->displayFormat = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): Time
    {
        $this->returnFormat = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::time, [
            'display_format' => $this->displayFormat,
            'return_format' => $this->returnFormat,
        ] );
    }
}