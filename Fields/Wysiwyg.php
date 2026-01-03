<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Wysiwyg extends AbstractField
{
    /** @var string */
    protected string $tabs = 'all';

    /** @var string */
    protected string $toolbar = 'full';

    /** @var bool */
    protected bool $mediaUpload = true;

    /**
     * @param string $value
     * @return static
     */
    public function tabs(string $value): Wysiwyg
    {
        if ( in_array( $value, ['all', 'visual', 'text'] ) ) {
            $this->tabs = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function allTabs(): Wysiwyg
    {
        return $this->tabs( 'all' );
    }

    /**
     * @return static
     */
    public function visualOnly(): Wysiwyg
    {
        return $this->tabs( 'visual' );
    }

    /**
     * @return static
     */
    public function textOnly(): Wysiwyg
    {
        return $this->tabs( 'text' );
    }

    /**
     * @param string $value
     * @return static
     */
    public function toolbar(string $value): Wysiwyg
    {
        if ( in_array( $value, [ 'full', 'basic' ] ) ) {
            $this->toolbar = $value;
        }

        return $this;
    }

    /**
     * @return static
     */
    public function fullToolbar(): Wysiwyg
    {
        return $this->toolbar( 'full' );
    }

    /**
     * @return static
     */
    public function basicToolbar(): Wysiwyg
    {
        return $this->toolbar( 'basic' );
    }

    /**
     * @param bool $value
     * @return static
     */
    public function showMediaButton(bool $value = true): Wysiwyg
    {
        $this->mediaUpload = $value;

        return $this;
    }

    /**
     * @return $this
     */
    public function hideMediaButton(): Wysiwyg
    {
        return $this->showMediaButton( false );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::wysiwyg, [
            'tabs' => $this->tabs,
            'toolbar' => $this->toolbar,
            'media_upload' => (int) $this->mediaUpload,
        ] );
    }
}