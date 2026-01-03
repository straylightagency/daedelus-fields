<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithChoices;
use Daedelus\Fields\Concerns\WithMultiple;
use Daedelus\Fields\Concerns\WithNullable;
use Daedelus\Fields\Concerns\WithPlaceholder;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Select extends AbstractField
{
    use WithChoices, WithNullable, WithPlaceholder, WithMultiple;

    /** @var bool */
    protected bool $ui = false;

    /** @var bool */
    protected bool $ajax = false;

    /**
     * @param string $value
     * @return static
     */
    public function withUi(string $value): Select
    {
        if ( in_array( $value, ['default', 'select2'] ) ) {
            $this->ui = $value === 'select2';
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function withDefaultUi(): Select
    {
        $this->ui = false;

        return $this;
    }

    /**
     * @return $this
     */
    public function withSelect2Ui(): Select
    {
        $this->ui = true;

        return $this;
    }

    /**
     * @param bool $value
     * @return $this
     */
    public function useAjax(bool $value = true): Select
    {
        $this->ajax = $value;

        return $this;
    }

    public function dontUseAjax(): Select
    {
        $this->ajax = false;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        if ( $this->ui || $this->ajax || strlen( $this->placeholder ) > 0 ) {
            $this->withSelect2Ui();
        }

        return $this->export( Fields::select, [
            'choices' => $this->choices,
            'allow_null' => (int) $this->nullable,
            'multiple' => (int) $this->multiple,
            'ui' => (int) $this->ui,
            'ajax' => (int) $this->ajax,
            'placeholder' => $this->placeholder,
        ] );
    }
}