<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithContent;
use Daedelus\Fields\Concerns\WithNumber;
use Daedelus\Fields\Concerns\WithPlaceholder;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Number extends AbstractField
{
    use WithNumber, WithContent, WithPlaceholder;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::number, [
            'placeholder' => $this->placeholder,
            'append' => $this->append,
            'prepend' => $this->prepend,
            'min' => $this->min > 0 ? $this->min : '',
            'max' => $this->max > 0 ? $this->max : '',
            'step' => $this->step > 0 ? $this->step : '',
        ] );
    }
}