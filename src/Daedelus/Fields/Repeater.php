<?php
namespace Daedelus\Fields;

use Daedelus\Fields\Contracts\Field;
use Daedelus\Fields\Concerns\WithButton;
use Daedelus\Fields\Concerns\WithMinMax;
use Daedelus\Fields\Concerns\WithSubfields;
use Daedelus\Fields\Concerns\WithLayout;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Repeater extends AbstractGroup implements Field
{
    use WithButton, WithMinMax, WithSubfields, WithLayout;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::repeater, [
            'layout' => $this->layout,
            'button_label' => $this->button,
            'min' => $this->min,
            'max' => $this->max,
            'sub_fields' => array_map( fn ( Field $field ) => $field->prepareToExport( $this->key )->toArray(), $this->fields ),
        ] );
    }
}