<?php

namespace Daedelus\Fields;

use Closure;
use Daedelus\Fields\Concerns\WithDebug;
use Daedelus\Fields\Concerns\WithJson;
use Daedelus\Fields\Concerns\WithParams;
use Daedelus\Fields\Concerns\WithSubfields;
use Daedelus\Fields\Contracts\Field;
use Daedelus\Fields\Contracts\Group;
use Illuminate\Support\Str;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Location implements Group
{
	use WithJson, WithSubfields, WithParams, WithDebug;

	/** @var string */
	protected string $key;

	/** @var string */
	protected string $name;

	/** @var array */
	protected array $location = [];

	/** @var int */
	protected int $menuOrder = 0;

	/** @var string */
	protected string $position = 'normal';

	/** @var string */
	protected string $style = 'default';

	/** @var string */
	protected string $labelPlacement = 'top';

	/** @var string */
	protected string $instructionPlacement = 'label';

	/** @var array */
	protected array $hideOnScreen = [];

	/** @var bool */
	protected bool $active = true;

	/** @var bool */
	protected bool $showInApi = true;

	/** @var string */
	protected string $description = '';

	/**
	 * @param string $name
	 * @param string|null $key
	 */
	public function __construct(string $name, string $key = null)
	{
		if ( $key === null ) {
			$key = Str::slug( $name, '_' );
		}

		$this->key = 'group_' . $key;
		$this->name = $name;
	}

	/**
	 * @param string $name
	 * @param string|null $key
	 * @param bool $build
	 *
	 * @return Location
	 */
	public static function make(string $name, string $key = null, bool $build = true): static
	{
		$location = new static( $name, $key );

		if ( $build ) {
			Builder::markForBuild( $location );
		}

		return $location;
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
	public static function postType(string $post_type, string $title, ?Closure $closure = null, string $key = null, bool $build = true): static
	{
		$location = self::make( $title, $key, $build );
		$location->andPostType( $post_type );

		$fields = null;

		if ( $closure ) {
			$fields = $closure( $location );
		}

		if ( is_array( $fields ) && !empty( $fields ) ) {
			$location->appendFields( $fields );
		}

		return $location;
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
	public static function pageTemplate(string $template_name, string $title, ?Closure $closure = null, string $key = null, bool $build = true): static
	{
		$location = self::make( $title, $key, $build );
		$location->andPageTemplate( $template_name );

		$fields = null;

		if ( $closure ) {
			$fields = $closure( $location );
		}

		if ( is_array( $fields ) && !empty( $fields ) ) {
			$location->appendFields( $fields );
		}

		return $location;
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
    public static function taxonomy(string $taxonomy, string $title, ?Closure $closure = null, string $key = null, bool $build = true): static
    {
        $location = self::make( $title, $key, $build );
        $location->andTaxonomy( $taxonomy );

        $fields = null;

        if ( $closure ) {
            $fields = $closure( $location );
        }

        if ( is_array( $fields ) && !empty( $fields ) ) {
            $location->appendFields( $fields );
        }

        return $location;
    }

	/**
	 * @param string $title
	 * @param Closure|null $closure
	 * @param string $page
	 * @param bool $build
	 *
	 * @return Location
	 */
	public static function optionsPage(string $title, ?Closure $closure = null, string $page = 'options', bool $build = true): static
	{
		$location = self::make( $title, $page, $build );
		$location->andOptionsPage( $page );

		$fields = null;

		if ( $closure ) {
			$fields = $closure( $location );
		}

		if ( is_array( $fields ) && !empty( $fields ) ) {
			$location->appendFields( $fields );
		}

		return $location;
	}

	/**
	 * @param string $param
	 * @param string $operator
	 * @param string|null $value
	 * @param string $boolean
	 * @return static
	 */
	public function showIf(string $param, string $operator, string $value = null, string $boolean = 'and'): Location
	{
		if ( func_num_args() === 2 ) {
			$value = $operator;
			$operator = '==';
		}

		if ( !in_array( $operator, [ '==', '!=' ] ) ) {
			$operator = '==';
		}

		$conditional = compact('param', 'operator', 'value');

		if ( $boolean === 'and' ) {
			$last = array_key_last( $this->location );

			if ( $last !== null ) {
				$this->location[ $last ][] = $conditional;
			} else {
				$this->location[] = [
					$conditional
				];
			}
		}

		if ( $boolean === 'or' ) {
			$this->location[] = [
				$conditional
			];
		}

		return $this;
	}

	/**
	 * @param string $param
	 * @param string $operator
	 * @param string|null $value
	 * @return static
	 */
	public function andShowIf(string $param, string $operator, string $value = null): Location
	{
		return $this->showIf( $param, $operator, $value );
	}

	/**
	 * @param string $param
	 * @param string $operator
	 * @param string|null $value
	 * @return static
	 */
	public function orShowIf(string $param, string $operator, string $value = null): Location
	{
		return $this->showIf( $param, $operator, $value, 'or' );
	}

	/**
	 * @param int $value
	 * @return static
	 */
	public function priorityOrder(int $value): Location
	{
		$this->menuOrder = $value;

		return $this;
	}

	/**
	 * @param string $value
	 * @return static
	 */
	public function position(string $value): Location
	{
		if ( in_array( $value, [ 'side', 'acf_after_title', 'normal' ] ) ) {
			$this->position = $value;
		}

		return $this;
	}

	/**
	 * @return static
	 */
	public function positionOnSide(): Location
	{
		return $this->position('side');
	}

	/**
	 * @return static
	 */
	public function positionAfterTitle(): Location
	{
		return $this->position('acf_after_title');
	}

	/**
	 * @return static
	 */
	public function positionBelow(): Location
	{
		return $this->position('normal');
	}

	/**
	 * @param string $value
	 * @return static
	 */
	public function style(string $value): Location
	{
		if ( in_array( $value, [ 'default', 'seamless' ] ) ) {
			$this->style = $value;
		}

		return $this;
	}

	/**
	 * @return static
	 */
	public function styleWithBox(): Location
	{
		return $this->style('default');
	}

	/**
	 * @return static
	 */
	public function styleWithoutBox(): Location
	{
		return $this->style('seamless');
	}

	/**
	 * @param string $value
	 * @return static
	 */
	public function labelsOn(string $value): Location
	{
		if ( in_array( $value, [ 'top', 'left' ] ) ) {
			$this->labelPlacement = $value;
		}

		return $this;
	}

	/**
	 * @return static
	 */
	public function labelsAboveFields(): Location
	{
		return $this->labelsOn('top');
	}

	/**
	 * @return static
	 */
	public function labelsBesideFields(): Location
	{
		return $this->labelsOn('left');
	}

	/**
	 * @param string $value
	 * @return static
	 */
	public function instructionsBelow(string $value): Location
	{
		if ( in_array( $value, [ 'label', 'field' ] ) ) {
			$this->instructionPlacement = $value;
		}

		return $this;
	}

	/**
	 * @return static
	 */
	public function instructionsBelowLabels(): Location
	{
		return $this->instructionsBelow('label');
	}

	/**
	 * @return static
	 */
	public function instructionsBelowFields(): Location
	{
		return $this->instructionsBelow('field');
	}

	/**
	 * @param ...$elements
	 * @return static
	 */
	public function hideOnScreen(...$elements): Location
	{
		$this->hideOnScreen = $elements;

		return $this;
	}

	/**
	 * @param ...$except
	 * @return Location
	 */
	public function hideAll(...$except): Location
	{
		return $this->hideOnScreen( ...array_diff( [
			'permalink',
			'the_content',
			'excerpt',
			'discussion',
			'comments',
			'revisions',
			'slug',
			'author',
			'format',
			'featured_image',
			'categories',
			'tags',
			'send-trackbacks',
		], $except ) );
	}

	/**
	 * @param bool $value
	 * @return static
	 */
	public function enable(bool $value = true): Location
	{
		$this->active = $value;

		return $this;
	}

	/**
	 * @return static
	 */
	public function disable(): Location
	{
		return $this->enable( false );
	}

	/**
	 * @param bool $value
	 * @return static
	 */
	public function showInApi(bool $value = true): Location
	{
		$this->showInApi = $value;

		return $this;
	}

	/**
	 * @return static
	 */
	public function hideInApi(): Location
	{
		return $this->showInApi( false );
	}

	/**
	 * @param string $value
	 * @return static
	 */
	public function description(string $value): Location
	{
		$this->description = $value;

		return $this;
	}

	/**
	 * @param int $value
	 *
	 *
	 * @return static
	 */
	public function andPage(int $value): Location
	{
		return $this->showIf('page', '==', $value, 'and' );
	}

	/**
	 * @param int $value
	 *
	 *
	 * @return static
	 */
	public function orPage(int $value): Location
	{
		return $this->showIf('page', '==', $value, 'or' );
	}

	/**
	 * @param int $value
	 *
	 * @return static
	 */
	public function andPageParent(int $value): Location
	{
		return $this->showIf('page_parent', '==', $value, 'and' );
	}

	/**
	 * @param int $value
	 *
	 * @return static
	 */
	public function orPageParent(int $value): Location
	{
		return $this->showIf('page_parent', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andPageTemplate(string $value): Location
	{
		return $this->showIf('page_template', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orPageTemplate(string $value): Location
	{
		return $this->showIf('page_template', '==', $value, 'or' );
	}

	/**
	 * @param int $value
	 *
	 * @return static
	 */
	public function andPost(int $value): Location
	{
		return $this->showIf('post', '==', $value, 'and' );
	}

	/**
	 * @param int $value
	 *
	 * @return static
	 */
	public function orPost(int $value): Location
	{
		return $this->showIf('post', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andPostType(string $value): Location
	{
		return $this->showIf('post_type', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orPostType(string $value): Location
	{
		return $this->showIf('post_type', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andPostCategory(string $value): Location
	{
		return $this->showIf('post_category', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orPostCategory(string $value): Location
	{
		return $this->showIf('post_category', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andPostTaxonomy(string $value): Location
	{
		return $this->showIf('post_taxonomy', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orPostTaxonomy(string $value): Location
	{
		return $this->showIf('post_taxonomy', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andPostFormat(string $value = 'standard'): Location
	{
		return $this->showIf('post_format', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orPostFormat(string $value = 'standard'): Location
	{
		return $this->showIf('post_format', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andPostStatus(string $value = 'publish'): Location
	{
		return $this->showIf('post_status', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orPostStatus(string $value = 'publish'): Location
	{
		return $this->showIf('post_status', '==', $value, 'or' );
	}

    /**
     * @param string $value
     *
     * @return static
     */
    public function andTaxonomy(string $value): Location
    {
        return $this->showIf('taxonomy', '==', $value, 'and' );
    }

    /**
     * @param string $value
     *
     * @return static
     */
    public function orTaxonomy(string $value): Location
    {
        return $this->showIf('taxonomy', '==', $value, 'or' );
    }

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andMenu(string $value = 'all'): Location
	{
		return $this->showIf('nav_menu', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orMenu(string $value = 'all'): Location
	{
		return $this->showIf('nav_menu', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andMenuItem(string $value = 'all'): Location
	{
		return $this->showIf('nav_menu_item', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orMenuItem(string $value = 'all'): Location
	{
		return $this->showIf('nav_menu_item', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andWidget(string $value = 'all'): Location
	{
		return $this->showIf('widget', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orWidget(string $value = 'all'): Location
	{
		return $this->showIf('widget', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andUserRole(string $value = 'administrator'): Location
	{
		return $this->showIf('current_user_role', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orUserRole(string $value = 'administrator'): Location
	{
		return $this->showIf('current_user_role', '==', $value, 'or' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function andOptionsPage(string $value = 'acf-options-common'): Location
	{
		return $this->showIf('options_page', '==', $value, 'and' );
	}

	/**
	 * @param string $value
	 *
	 * @return static
	 */
	public function orOptionsPage(string $value = 'acf-options-common'): Location
	{
		return $this->showIf('options_page', '==', $value, 'or' );
	}

	/**
	 * Build and initialise the group
	 */
	public function build(): void
	{
		if ( function_exists('acf_add_local_field_group') ) {
			acf_add_local_field_group( $this->toArray() );
		}
	}

	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return array_merge( [
			'key' => $this->key,
			'title' => $this->name,
			'fields' => array_map( fn( Field $field ) => $field->prepareToExport( $this->key )->toArray(), $this->fields ),
			'location' => $this->location,
			'menu_order' => $this->menuOrder,
			'position' => $this->position,
			'style' => $this->style,
			'label_placement' => $this->labelPlacement,
			'instruction_placement' => $this->instructionPlacement,
			'hide_on_screen' => $this->hideOnScreen,
			'show_in_rest' => $this->showInApi,
		] );
	}
}