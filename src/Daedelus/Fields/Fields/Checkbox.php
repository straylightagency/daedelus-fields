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
class Checkbox extends AbstractField
{
    use WithChoices, WithPositionableLayout;

    /** @var bool */
    protected bool $allowCustom = false;

    /** @var bool */
    protected bool $saveCustom = false;

    /** @var bool */
    protected bool $toggle = false;

    /** @var string */
    protected string $format = 'value';

    /**
     * @param bool $value
     * @return static
     */
    public function allowCustom(bool $value = true): Checkbox
    {
        $this->allowCustom = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function disallowCustom(): Checkbox
    {
        return $this->allowCustom( false );
    }

    /**
     * @param bool $value
     * @return static
     */
    public function saveCustom(bool $value = true): Checkbox
    {
        $this->saveCustom = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function dontSaveCustom(): Checkbox
    {
        return $this->saveCustom( false );
    }

    /**
     * @param bool $value
     * @return static
     */
    public function showToggleAll(bool $value = true): Checkbox
    {
        $this->toggle = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function hideToggleAll(): Checkbox
    {
        return $this->showToggleAll( false );
    }

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): Checkbox
    {
        if ( in_array( $value, ['value', 'label', 'array'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function returnValue(): Checkbox
    {
        return $this->return('value');
    }

    /**
     * @return static
     */
    public function returnLabel(): Checkbox
    {
        return $this->return('label');
    }

    /**
     * @return static
     */
    public function returnArray(): Checkbox
    {
        return $this->return('array');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::checkbox, [
            'choices' => $this->choices,
            'layout' => $this->layout,
            'allow_custom' => $this->allowCustom,
            'save_custom' => $this->saveCustom,
            'toggle' => $this->toggle,
            'return_format' => $this->format,
        ] );
    }
}