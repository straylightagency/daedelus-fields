<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithContent;
use Daedelus\Fields\Concerns\WithDisabled;
use Daedelus\Fields\Concerns\WithMaxLength;
use Daedelus\Fields\Concerns\WithPlaceholder;
use Daedelus\Fields\Concerns\WithReadOnly;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Text extends AbstractField
{
    use WithPlaceholder, WithContent, WithReadOnly, WithDisabled, WithMaxLength;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::text, [
            'placeholder' => $this->placeholder,
            'append' => $this->append,
            'prepend' => $this->prepend,
            'maxlength' => $this->maxLength === 0 ? '' : $this->maxLength,
            'readonly' => (int) $this->readOnly,
            'disabled' => (int) $this->disabled,
        ] );
    }
}