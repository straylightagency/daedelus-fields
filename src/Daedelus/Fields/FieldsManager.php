<?php

namespace Daedelus\Fields;

use Closure;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class FieldsManager
{
	/** @var Builder */
	protected Builder $builder;

	/**
	 *
	 */
	public function __construct()
	{
		$this->builder = new Builder();
	}

	/**
	 * @param Closure|null $closure
	 *
	 * @return Builder
	 */
	public function register(?Closure $closure = null): Builder
	{
		return $this->builder->register( $closure );
	}

	/**
	 * @param array $config
	 *
	 * @return Builder
	 */
	public function config(array $config): Builder
	{
		return $this->builder->config( $config );
	}

	/**
	 * @param Closure $closure
	 *
	 * @return Builder
	 */
	public function onInit(Closure $closure): Builder
	{
		return $this->builder->onInit( $closure );
	}

	/**
	 * @param bool $value
	 *
	 * @return Builder
	 */
	public function disableAdmin(bool $value = true): Builder
	{
		return $this->builder->disableAdmin( $value );
	}

	/**
	 * @return Builder
	 */
	public function enableAdmin(): Builder
	{
		return $this->builder->enableAdmin();
	}

	/**
	 * @param bool $value
	 *
	 * @return Builder
	 */
	public function disableRestApi(bool $value = true): Builder
	{
		return $this->builder->disableRestApi( $value );
	}

	/**
	 * @return Builder
	 */
	public function enableRestApi(): Builder
	{
		return $this->builder->enableRestApi();
	}

	/**
	 * @param string $value
	 *
	 * @return Builder
	 */
	public function restFormat(string $value): Builder
	{
		return $this->builder->restFormat( $value );
	}

	/**
	 * @return Builder
	 */
	public function restStandardFormat(): Builder
	{
		return $this->builder->restStandardFormat();
	}

	/**
	 * @return Builder
	 */
	public function restLightFormat(): Builder
	{
		return $this->builder->restLightFormat();
	}

	/**
	 * Get the configuration for a specific field
	 *
	 * @param string $config_name
	 * @return array
	 */
	public static function getConfigOf(string $config_name): array
	{
		return Builder::getConfigOf( $config_name );
	}

	/**
	 * @param Location $location
	 *
	 * @return void
	 */
	public static function markForBuild(Location $location): void
	{
		Builder::markForBuild( $location );
	}

	/**
	 * @param string $name
	 * @param string|null $key
	 *
	 * @return Location
	 */
	public function location(string $name, string $key = null): Location
	{
		return Location::make( $name, $key );
	}

	/**
	 * @param string $post_type
	 * @param string $title
	 * @param Closure|null $closure
	 * @param string|null $key
	 * @param bool $build
	 *
	 * @return Location
	 */
	public function postType(string $post_type, string $title, ?Closure $closure = null, string $key = null, bool $build = true): Location
	{
		return Location::postType( $post_type, $title, $closure, $key, $build );
	}

	/**
	 * @param string $template_name
	 * @param string $title
	 * @param Closure|null $closure
	 * @param string|null $key
	 * @param bool $build
	 *
	 * @return Location
	 */
	public function pageTemplate(string $template_name, string $title, ?Closure $closure = null, string $key = null, bool $build = true): Location
	{
		return Location::pageTemplate( $template_name, $title, $closure, $key, $build );
	}

	/**
	 * @param string $title
	 * @param Closure|null $closure
	 * @param string $page
	 * @param bool $build
	 *
	 * @return Location
	 */
	public function optionsPage(string $title, ?Closure $closure = null, string $page = 'options', bool $build = true): Location
	{
		return Location::optionsPage( $title, $closure, $page, $build );
	}

    /**
     * @param string $taxonomy
     * @param string $title
     * @param Closure|null $closure
     * @param string|null $key
     * @param bool $build
     *
     * @return Location
     */
    public function taxonomy(string $taxonomy, string $title, ?Closure $closure = null, string $key = null, bool $build = true): Location
    {
        return Location::taxonomy( $taxonomy, $title, $closure, $key, $build );
    }
}