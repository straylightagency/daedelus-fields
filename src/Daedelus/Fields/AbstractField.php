<?php
namespace Daedelus\Fields;

use Closure;
use Daedelus\Fields\Concerns\WithDebug;
use Daedelus\Fields\Concerns\WithJson;
use Daedelus\Fields\Concerns\WithParams;
use Daedelus\Fields\Contracts\Field;
use Daedelus\Support\Filters;
use Illuminate\Support\Str;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
abstract class AbstractField implements Field
{
	use WithJson, WithDebug, WithParams;

	/** @var string */
	protected string $label;

	/** @var string */
	protected string $key;

	/** @var string */
	protected string $name;

	/** @var string */
	protected string $instructions = '';

	/** @var string */
	protected string $default = '';

	/** @var int */
	protected int $required = 0;

	/** @var array */
	protected array $conditionalLogic = [];

	/** @var array */
	protected array $wrapperAttributes = [
		'width' => '',
		'class' => '',
		'id'    => '',
	];

    /** @var array */
    protected array $callbacks = [];

	/**
	 * @param string $label
	 * @param string|null $name
	 * @param string|null $key
	 */
	public function __construct(string $label, string $name = null, string $key = null)
	{
		if ( $name === null ) {
			$name = $label;
		}

		if ( $key === null ) {
			$key = $name;
		}

		$this->label = $label;
		$this->name = Str::slug( $name, '_' );
		$this->key = Str::slug( $key, '_' );
	}

	/**
	 * @param string $label
	 * @param string|null $name
	 * @param string|null $key
	 *
	 * @return AbstractField
	 */
	public static function make(string $label, string $name = null, string $key = null): static
	{
		return new static( $label, $name, $key );
	}

	/**
	 * @return static
	 */
	public static function config(): static
	{
		return new static( '__label__', '__name__', '__key__' );
	}

	/**
	 * @param int $width
	 * @param string $class_list
	 * @param string $id
	 *
	 * @return static
	 */
	public function wrapper(int $width, string $class_list, string $id): static
	{
		return $this->wrapperWidth( $width )->wrapperClass( $class_list )->wrapperId( $id );
	}

	/**
	 * @param int $width
	 *
	 * @return static
	 */
	public function wrapperWidth(int $width): static
	{
		$this->wrapperAttributes['width'] = $width;

		return $this;
	}

	/**
	 * @param string $class_list
	 *
	 * @return static
	 */
	public function wrapperClass(string $class_list): static
	{
		$this->wrapperAttributes['class'] = $class_list;

		return $this;
	}

	/**
	 * @param string $id
	 *
	 * @return static
	 */
	public function wrapperId(string $id): static
	{
		$this->wrapperAttributes['id'] = $id;

		return $this;
	}
	/**
	 * @param string $param
	 * @param string $operator
	 * @param string|null $value
	 * @param string $boolean
	 *
	 * @return static
	 */
	public function showIf(string $param, string $operator, string $value = null, string $boolean = 'and'): static
	{
		if ( func_num_args() === 2 ) {
			$value = $operator;
			$operator = '==';
		}

		if ( !in_array( $operator, [ '==', '!=' ] ) ) {
			$operator = '==';
		}

		if ( !in_array( $boolean, [ 'and', 'or' ] ) ) {
			$boolean = 'and';
		}

		$conditional = compact('param', 'operator', 'value');

		if ( $boolean === 'and' ) {
			$last = array_key_last( $this->conditionalLogic );

			if ( $last !== null ) {
				$this->conditionalLogic[ $last ][] = $conditional;
			} else {
				$this->conditionalLogic[] = [
					$conditional
				];
			}
		}

		if ( $boolean === 'or' ) {
			$this->conditionalLogic[] = [
				$conditional
			];
		}

		return $this;
	}

	/**
	 * @param string $param
	 * @param string $operator
	 * @param string|null $value
	 *
	 * @return static
	 */
	public function andShowIf(string $param, string $operator, string $value = null): static
	{
		return $this->showIf( $param, $operator, $value );
	}

	/**
	 * @param string $param
	 * @param string $operator
	 * @param string|null $value
	 *
	 * @return static
	 */
	public function orShowIf(string $param, string $operator, string $value = null): static
	{
		return $this->showIf( $param, $operator, $value, 'or' );
	}

	/**
	 * @param bool $value
	 *
	 * @return static
	 */
	public function required(bool $value = true): static
	{
		$this->required = $value;

		return $this;
	}

	/**
	 * @return static
	 */
	public function notRequired(): static
	{
		return $this->required( false );
	}

	/**
	 * @param string $default
	 *
	 * @return static
	 */
	public function default(string $default): static
	{
		$this->default = $default;

		return $this;
	}

	/**
	 * @param string $instructions
	 *
	 * @return static
	 */
	public function instructions(string $instructions): static
	{
		$this->instructions = $instructions;

		return $this;
	}

	/**
	 * @param callable $callback
	 *
	 * @return static
	 */
	public function onLoad(callable $callback): static
	{
        $this->callbacks[] = fn (string $key) => Filters::add("acf/load_field/key={$key}", $callback, 10, 4 );

		return $this;
	}

	/**
	 * @param callable $callback
	 *
	 * @return static
	 */
	public function onValue(callable $callback): static
	{
		$this->callbacks[] = fn (string $key) => Filters::add("acf/load_value/key={$key}", $callback, 10, 4 );

		return $this;
	}

	/**
	 * @param callable $callback
	 *
	 * @return static
	 */
	public function onUpdate(callable $callback): static
	{
		$this->callbacks[] = fn (string $key) => Filters::add("acf/update_value/key={$key}", $callback, 10, 4 );

		return $this;
	}

	/**
	 * @param callable $callback
	 *
	 * @return static
	 */
	public function onFormat(callable $callback): static
	{
		$this->callbacks[] = fn (string $key) => Filters::add("acf/format_value/key={$key}", $callback, 10, 4 );

		return $this;
	}

    /**
     * @param callable $callback
     *
     * @return static
     */
    public function onValidate(callable $callback): static
    {
        $this->callbacks[] = fn (string $key) => Filters::add("acf/validate_value/key={$key}", $callback, 10, 4 );

        return $this;
    }

	/**
	 * Return the generated field key
	 *
	 * @return string
	 */
	protected function getKey(): string
	{
		return '_acf_field_' . $this->key;
	}

    /**
     * Prepare the field to be exported, chunk the key with his parent his and initialize ACF filters callbacks
     *
     * @param string|null $parent_key
     * @return AbstractField
     */
    public function prepareToExport(?string $parent_key = null): static
    {
        if ( $parent_key ) {
            $this->key = $parent_key . '_' . $this->key;
        }

        array_map( fn ( Closure $callback ) => $callback( $this->getKey() ), $this->callbacks );

        return $this;
    }

	/**
	 * @param string $type
	 * @param array $more_params
	 * @return array
	 */
	protected function export(string $type, array $more_params = []): array
	{
		return array_merge(
			$this->params, [
			'key' => $this->getKey(),
			'name' => $this->name,
			'label' => $this->label,
			'type' => $type,
			'instructions' => $this->instructions,
			'required' => $this->required,
			'conditional_logic' => empty( $this->conditionalLogic ) ? 0 : $this->conditionalLogic,
			'wrapper' => $this->wrapperAttributes,
			'default_value' => $this->default,
		], Builder::getConfigOf( $type ), $more_params );
	}
}