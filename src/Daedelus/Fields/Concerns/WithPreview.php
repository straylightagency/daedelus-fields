<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class Preview
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithPreview
{
    /** @var string */
    protected string $previewSize = 'thumbnail';

    /**
     * @param string $value
     * @return static
     */
    public function previewSize(string $value): static
    {
        $this->previewSize = $value;

        return $this;
    }

    /**
     * @return static
     */
    public function previewThumbnail(): static
    {
        return $this->previewSize('thumbnail');
    }

    /**
     * @return static
     */
    public function previewMedium(): static
    {
        return $this->previewSize('medium');
    }

    /**
     * @return static
     */
    public function previewMediumLarge(): static
    {
        return $this->previewSize('medium_large');
    }

    /**
     * @return static
     */
    public function previewLarge(): static
    {
        return $this->previewSize('large');
    }

    /**
     * @return static
     */
    public function previewFullSize(): static
    {
        return $this->previewSize('full_size');
    }
}