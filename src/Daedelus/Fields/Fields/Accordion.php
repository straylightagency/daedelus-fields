<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Accordion extends AbstractField
{
    /** @var bool */
    protected bool $open = false;

    /** @var bool */
    protected bool $multiExpand = false;

    /**
     * @param string $label
     * @param string|null $key
     */
    public function __construct(string $label, string $key = null)
    {
        parent::__construct( $label, '', $key );
    }

    /**
     * @param bool $value
     * @return static
     */
    public function open(bool $value = true): Accordion
    {
        $this->open = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function close(): Accordion
    {
        return $this->open( false );
    }

    /**
     * @param bool $value
     * @return static
     */
    public function multiExpand(bool $value = true): Accordion
    {
        $this->multiExpand = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function dontMultiExpand(): Accordion
    {
        return $this->multiExpand( false );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::accordion, [
            'open' => (int) $this->open,
            'multi_expand' => (int) $this->multiExpand,
        ] );
    }
}