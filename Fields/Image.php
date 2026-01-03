<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithFile;
use Daedelus\Fields\Concerns\WithImage;
use Daedelus\Fields\Concerns\WithLibrary;
use Daedelus\Fields\Concerns\WithPreview;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Image extends AbstractField
{
    use WithFile, WithImage, WithLibrary, WithPreview;

    /** @var string */
    protected string $format = 'array';

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): Image
    {
        if ( in_array( $value, ['array', 'url', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function returnArray(): Image
    {
        return $this->return('array');
    }

    /**
     * @return static
     */
    public function returnUrl(): Image
    {
        return $this->return('url');
    }

    /**
     * @return static
     */
    public function returnId(): Image
    {
        return $this->return('id');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::image, [
            'return_format' => $this->format,
            'preview_size' => $this->previewSize,
            'library' => $this->restrictLibrary,
            'min_width' => $this->minWidth,
            'min_height' => $this->minHeight,
            'min_size' => $this->minSize,
            'max_width' => $this->maxWidth,
            'max_height' => $this->maxHeight,
            'max_size' => $this->maxSize,
            'mime_types' => implode(',', $this->mimeTypes ),
        ] );
    }
}