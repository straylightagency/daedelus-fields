<?php

namespace Daedelus\Fields;

use Closure;
use Daedelus\Fields\Contracts\Field;
use Daedelus\Fields\Contracts\Group;
use Daedelus\Support\Actions;
use Daedelus\Support\Filters;
use InvalidArgumentException;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Builder
{
	/** @var Location[] */
	static protected array $markedForBuild = [];

	/** @var array */
	static protected array $config = [];

	/** @var bool */
	static protected bool $registered = false;

	/**
	 * @param Closure|null $closure
	 *
	 * @return static
	 */
	public function register(?Closure $closure = null): static {
		if ( $closure ) {
			$closure();
		}

		if ( !static::$registered ) {
			$this->onInit( function () {
				foreach ( static::$markedForBuild as $group ) {
					$group->build();
				}
			} );

			static::$registered = true;
		}

		return $this;
	}

	/**
	 * @param array $config
	 *
	 * @return static
	 */
	public function config(array $config): static
	{
		$config = array_map( function ( $field ) {
			if ( $field instanceof Field || $field instanceof Group ) {
				$field = $field->toArray();
			}

			if ( is_array( $field ) ) {
				/** Removing sensitives keys like key, name, label and type */
				return array_diff_key( $field, array_flip( ['key', 'name', 'label', 'type'] ) );
			}

			throw new InvalidArgumentException('Config array must only contains Field instances or arrays');
		}, $config );

		static::$config = array_merge( static::$config, $config );

		return $this;
	}

	/**
	 * @param Closure $closure
	 *
	 * @return static
	 */
	public function onInit(Closure $closure): static
	{
		Actions::add('acf/init', $closure );

		return $this;
	}

	/**
	 * @param bool $value
	 *
	 * @return static
	 */
	public function disableAdmin(bool $value = true): static
	{
		Filters::add('acf/settings/show_admin', fn () => !$value );

		return $this;
	}

	/**
	 * @return static
	 */
	public function enableAdmin(): static
	{
		$this->disableAdmin( false );

		return $this;
	}

	/**
	 * @param bool $value
	 *
	 * @return static
	 */
	public function disableRestApi(bool $value = true): static
	{
		Filters::add('acf/settings/rest_api_enabled', fn () => !$value );

		return $this;
	}

	/**
	 * @return static
	 */
	public function enableRestApi(): static
	{
		$this->disableRestApi( false );

		return $this;
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function restFormat(string $value): static
	{
		$value = in_array( $value, [ 'standard', 'light' ] ) ? $value : 'standard';

		Filters::add('acf/settings/rest_api_format', fn () => $value );

		return $this;
	}

	/**
	 * @return static
	 */
	public function restStandardFormat(): static
	{
		$this->restFormat( 'standard' );

		return $this;
	}

	/**
	 * @return static
	 */
	public function restLightFormat(): static
	{
		$this->restFormat( 'light' );

		return $this;
	}

	/**
	 * Get the configuration for a specific field
	 *
	 * @param string $config_name
	 * @return array
	 */
	public static function getConfigOf(string $config_name): array
	{
		return array_merge(
			static::$config[ Fields::all ] ?? [],
			static::$config[ $config_name ] ?? []
		);
	}

	/**
	 * @param Location $location
	 *
	 * @return void
	 */
	public static function markForBuild(Location $location): void
	{
		static::$markedForBuild[] = $location;
	}
}