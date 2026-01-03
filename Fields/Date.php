<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Date extends AbstractField
{
    /** @var string */
    protected string $displayFormat = 'd/m/Y';

    /** @var string  */
    protected string $returnFormat = 'd/m/Y';

    /** @var int  */
    protected int $weekStartsOn = 1;

    /**
     * @param string $value
     * @return static
     */
    public function display(string $value): Date
    {
        $this->displayFormat = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): Date
    {
        $this->returnFormat = $value;

        return $this;
    }

    /**
     * @param int $value
     * @return static
     */
    public function weekStartsOn(int $value): Date
    {
        if ( $value >= 0 && $value <= 6 ) {
            $this->weekStartsOn = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function weekStartsOnMonday(): Date
    {
        return $this->weekStartsOn( 1 );
    }

    /**
     * @return static
     */
    public function weekStartsOnTuesday(): Date
    {
        return $this->weekStartsOn( 2 );
    }

    /**
     * @return static
     */
    public function weekStartsOnWednesday(): Date
    {
        return $this->weekStartsOn( 3 );
    }

    /**
     * @return static
     */
    public function weekStartsOnThursday(): Date
    {
        return $this->weekStartsOn( 4 );
    }

    /**
     * @return static
     */
    public function weekStartsOnFriday(): Date
    {
        return $this->weekStartsOn( 5 );
    }

    /**
     * @return static
     */
    public function weekStartsOnSaturday(): Date
    {
        return $this->weekStartsOn( 6 );
    }

    /**
     * @return $this
     */
    public function weekStartsOnSunday(): Date
    {
        return $this->weekStartsOn( 0 );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::date, [
            'display_format' => $this->displayFormat,
            'return_format' => $this->returnFormat,
            'first_day' => $this->weekStartsOn,
        ] );
    }
}