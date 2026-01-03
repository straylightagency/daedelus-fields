<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithFile;
use Daedelus\Fields\Concerns\WithImage;
use Daedelus\Fields\Concerns\WithLibrary;
use Daedelus\Fields\Concerns\WithMinMax;
use Daedelus\Fields\Concerns\WithPreview;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Gallery extends AbstractField
{
    use WithFile, WithImage, WithLibrary, WithPreview, WithMinMax;

    /** @var string */
    protected string $format = 'array';

    /** @var string */
    protected string $insert = 'append';

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): Gallery
    {
        if ( in_array( $value, ['array', 'url', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function returnArray(): Gallery
    {
        return $this->return('array');
    }

    /**
     * @return static
     */
    public function returnUrl(): Gallery
    {
        return $this->return('url');
    }

    /**
     * @return static
     */
    public function returnId(): Gallery
    {
        return $this->return('id');
    }

    /**
     * @param string $value
     * @return static
     */
    public function insertNew(string $value): Gallery
    {
        if ( in_array( $value, ['append', 'prepend'] ) ) {
            $this->insert = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function insertAppend(): Gallery
    {
        return $this->insertNew( 'append' );
    }

    /**
     * @return static
     */
    public function insertPrepend(): Gallery
    {
        return $this->insertNew( 'prepend' );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::gallery, [
            'return_format' => $this->format,
            'preview_size' => $this->previewSize,
            'insert' => $this->insert,
            'library' => $this->restrictLibrary,
            'min_width' => $this->minWidth,
            'min_height' => $this->minHeight,
            'min_size' => $this->minSize,
            'max_width' => $this->maxWidth,
            'max_height' => $this->maxHeight,
            'max_size' => $this->maxSize,
            'mime_types' => implode(',', $this->mimeTypes ),
            'min' => $this->min,
            'max' => $this->max,
        ] );
    }
}