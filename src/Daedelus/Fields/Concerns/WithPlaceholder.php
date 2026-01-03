<?php
namespace Daedelus\Fields\Concerns;

/**
 * Class Placeholder
 *
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithPlaceholder
{
    /** @var string */
    protected string $placeholder = '';

	/**
	 * @param string $value
	 *
	 * @return static
	 */
    public function placeholder(string $value): static
    {
        $this->placeholder = $value;

        return $this;
    }
}