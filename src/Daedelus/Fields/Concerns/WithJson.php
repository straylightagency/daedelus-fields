<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithJson
{
	/**
	 * @return array
	 */
	abstract public function toArray(): array;

	/**
	 * @return false|string
	 */
	public function toJson(): bool|string
	{
		return json_encode( $this->toArray() );
	}
}