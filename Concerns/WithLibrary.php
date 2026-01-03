<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithLibrary
{
    /** @var string */
    protected string $restrictLibrary = 'all';

    /**
     * @param string $value
     *
     * @return static
     */
    public function restrictLibrary(string $value): static
    {
        if ( in_array( $value, ['all', 'uploadedTo'] ) ) {
            $this->restrictLibrary = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function showAll(): static
    {
        return $this->restrictLibrary('all');
    }

    /**
     * @return static
     */
    public function onlyUploaded(): static
    {
        return $this->restrictLibrary('uploadedTo');
    }
}