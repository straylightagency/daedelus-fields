<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithChoices;
use Daedelus\Fields\Concerns\WithPositionableLayout;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Radio extends AbstractField
{
    use WithChoices, WithPositionableLayout;

    /** @var bool */
    protected bool $allowOtherChoice = false;

    /** @var bool */
    protected bool $saveOtherChoice = false;

    /**
     * @param bool $value
     * @return static
     */
    public function allowOtherChoice(bool $value = true): Radio
    {
        $this->allowOtherChoice = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function disallowOtherChoice(): Radio
    {
        return $this->allowOtherChoice( false );
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function saveOtherChoice(bool $value = true): Radio
    {
        $this->saveOtherChoice = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function dontSaveOtherChoice(): Radio
    {
        return $this->saveOtherChoice( false );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::radio, [
            'choices' => $this->choices,
            'other_choice' => (int) $this->allowOtherChoice,
            'save_other_choice' => (int) $this->saveOtherChoice,
            'layout' => $this->layout,
        ] );
    }
}