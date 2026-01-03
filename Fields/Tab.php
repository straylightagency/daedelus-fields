<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Tab extends AbstractField
{
    /** @var string */
    protected string $placement = 'top';

    /**
     * @param string $label
     * @param string|null $key
     */
    public function __construct(string $label, string $key = null)
    {
        parent::__construct( $label, '', $key );
    }

    /**
     * @param string $value
     * @return static
     */
    public function placement(string $value): Tab
    {
        if ( in_array( $value, [ 'top', 'left' ] ) ) {
            $this->placement = $value;
        }

        return $this;
    }

    /**
     * Define the placement as top aligned
     *
     * @return static
     */
    public function topAligned(): Tab
    {
        return $this->placement( 'top' );
    }

    /**
     * Define the placement as left aligned
     *
     * @return static
     */
    public function leftAligned(): Tab
    {
        return $this->placement( 'left' );
    }

    /**
     *
     *
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::tab, [
            'placement' => $this->placement,
        ] );
    }
}