<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithChoices;
use Daedelus\Fields\Concerns\WithNullable;
use Daedelus\Fields\Concerns\WithPositionableLayout;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class ButtonGroup extends AbstractField
{
    use WithChoices, WithNullable, WithPositionableLayout;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::buttonGroup, [
            'choices' => $this->choices,
            'layout' => $this->layout,
            'allow_null' => (int) $this->nullable,
        ] );
    }
}