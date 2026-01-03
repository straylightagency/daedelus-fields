<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithMessage;
use Daedelus\Fields\Concerns\WithNewLines;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Message extends AbstractField
{
    use WithMessage, WithNewLines;

    /** @var bool */
    protected bool $escHtml = false;

    /**
     * @param bool $value
     * @return static
     */
    public function escapeHtml(bool $value = true): Message
    {
        $this->escHtml = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function dontEscapeHtml(): Message
    {
        return $this->escapeHtml( false );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::message, [
            'message' => $this->message,
            'new_lines' => $this->newLines,
            'esc_html' => (int) $this->escHtml,
        ] );
    }
}