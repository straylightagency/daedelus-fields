<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithFile;
use Daedelus\Fields\Concerns\WithLibrary;
use Daedelus\Fields\Concerns\WithPreview;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class File extends AbstractField
{
    use WithLibrary, WithFile, WithPreview;

    /** @var string */
    protected string $format = 'array';

    /**
     * @param string $value
     * @return static
     */
    public function return(string $value): File
    {
        if ( in_array( $value, ['array', 'url', 'id'] ) ) {
            $this->format = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function returnArray(): File
    {
        return $this->return('array');
    }

    /**
     * @return static
     */
    public function returnUrl(): File
    {
        return $this->return('url');
    }

    /**
     * @return static
     */
    public function returnId(): File
    {
        return $this->return('id');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::file, [
            'return_format' => $this->format,
            'preview_size' => $this->previewSize,
            'library' => $this->restrictLibrary,
            'min_size' => $this->minSize,
            'max_size' => $this->maxSize,
            'mime_types' => implode(',', $this->mimeTypes ),
        ] );
    }
}