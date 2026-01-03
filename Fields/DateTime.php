<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class DateTime extends Date
{
    /** @var string */
    protected string $displayFormat = 'd/m/Y g:i a';

    /** @var string  */
    protected string $returnFormat = 'd/m/Y g:i a';

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::dateTime, [
            'display_format' => $this->displayFormat,
            'return_format' => $this->returnFormat,
            'first_day' => $this->weekStartsOn,
        ] );
    }
}