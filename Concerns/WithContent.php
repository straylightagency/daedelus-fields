<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithContent
{
    /** @var string */
    protected string $append = '';

    /** @var string */
    protected string $prepend = '';

	/**
	 * @param string $content
	 *
	 * @return static
	 */
    public function append(string $content): static
    {
        $this->append = $content;

        return $this;
    }

	/**
	 * @param string $content
	 *
	 * @return static
	 */
    public function prepend(string $content): static
    {
        $this->prepend = $content;

        return $this;
    }
}