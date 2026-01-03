<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class Message
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithMessage
{
    /** @var string */
    protected string $message = '';

    /**
     * @param string $content
     *
     * @return static
     */
    public function message(string $content): static
    {
        $this->message = $content;

        return $this;
    }
}