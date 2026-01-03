<?php namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithContent;
use Daedelus\Fields\Concerns\WithDisabled;
use Daedelus\Fields\Concerns\WithMaxLength;
use Daedelus\Fields\Concerns\WithNewLines;
use Daedelus\Fields\Concerns\WithPlaceholder;
use Daedelus\Fields\Concerns\WithReadOnly;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Textarea extends AbstractField
{
    use WithContent, WithPlaceholder, WithNewLines, WithReadOnly, WithDisabled, WithMaxLength;

    /** @var int */
    protected int $rows = 0;

    /**
     * @param int $value
     * @return static
     */
    public function rows(int $value): Textarea
    {
        $this->rows = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::textarea, [
            'placeholder' => $this->placeholder,
            'rows' => $this->rows > 0 ? $this->rows : '',
            'new_lines' => $this->newLines,
            'maxlength' => $this->maxLength > 0 ? $this->maxLength : '',
            'readonly' => $this->readOnly,
            'disabled' => $this->disabled,
        ] );
    }
}