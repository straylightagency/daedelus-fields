<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithPlaceholder;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Url extends AbstractField
{
    use WithPlaceholder;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::url, [
            'placeholder' => $this->placeholder,
        ] );
    }
}