<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithMultiple;
use Daedelus\Fields\Concerns\WithNullable;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class PageLink extends AbstractField
{
    use WithNullable, WithMultiple;

    /** @var string */
    protected string $postType = '';

    /** @var string */
    protected string $taxonomy = '';

    /**
     * @param string $value
     * @return static
     */
    public function postType(string $value): PageLink
    {
        $this->postType = $value;

        return $this;
    }

    /**
     * @param string $value
     * @return static
     */
    public function taxonomy(string $value): PageLink
    {
        $this->taxonomy = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::pageLink, [
            'post_type' => $this->postType,
            'taxonomy' => $this->taxonomy,
            'allow_null' => (int) $this->nullable,
            'multiple' => (int) $this->multiple,
        ] );
    }
}