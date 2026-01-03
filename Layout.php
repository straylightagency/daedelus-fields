<?php
namespace Daedelus\Fields;

use Daedelus\Fields\Contracts\Field;
use Daedelus\Fields\Concerns\WithSubfields;
use Daedelus\Fields\Concerns\WithLayout;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Layout extends AbstractGroup
{
    use WithSubfields, WithLayout;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::layout, [
            'layout' => $this->layout,
            'sub_fields' => array_map( fn ( Field $field ) => $field->prepareToExport( $this->key )->toArray(), $this->fields ),
        ] );
    }
}