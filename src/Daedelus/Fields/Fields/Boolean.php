<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithMessage;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Boolean extends AbstractField
{
    use WithMessage;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::boolean, [
            'message' => $this->message,
        ] );
    }
}