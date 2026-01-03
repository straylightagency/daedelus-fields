<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithParams
{
	/** @var array */
	protected array $params = [];

	/**
	 * @param string $key
	 * @param mixed $value
	 * @return static
	 */
	public function param(string $key, mixed $value): static
	{
		$this->params[ $key ] = $value;

		return $this;
	}

	/**
	 * @param array $parameters
	 * @return static
	 */
	public function params(array $parameters): static
	{
		$parameters = array_filter( $parameters, fn ( $key ) => is_string( $key ), ARRAY_FILTER_USE_KEY );

		foreach ( $parameters as $key => $value ) {
			$this->param( $key, $value );
		}

		return $this;
	}
}