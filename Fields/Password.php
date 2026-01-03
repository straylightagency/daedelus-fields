<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithContent;
use Daedelus\Fields\Concerns\WithPlaceholder;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Password extends AbstractField
{
    use WithPlaceholder, WithContent;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::password, [
            'placeholder' => $this->placeholder,
            'append' => $this->append,
            'prepend' => $this->prepend,
        ] );
    }
}