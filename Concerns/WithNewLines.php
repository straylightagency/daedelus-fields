<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class NewLines
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithNewLines
{
    /** @var string */
    protected string $newLines = 'wpautop';

    /**
     * @param string $value
     *
     * @return static
     */
    public function newLines(string $value): static
    {
        if ( !in_array( $value, ['wpautop', 'br', ''] ) ) {
            $value = 'wpautop';
        }

        $this->newLines = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function paragraphs(): static
    {
        return $this->newLines( 'wpautop' );
    }

    /**
     * @return static
     */
    public function breakLines(): static
    {
        return $this->newLines( 'br' );
    }

    /**
     * @return static
     */
    public function noFormatting(): static
    {
        return $this->newLines( '' );
    }
}