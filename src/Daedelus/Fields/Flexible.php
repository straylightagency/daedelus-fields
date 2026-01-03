<?php
namespace Daedelus\Fields;

use Closure;
use Daedelus\Fields\Concerns\WithButton;
use Daedelus\Fields\Concerns\WithMinMax;
use Daedelus\Fields\Contracts\Field;
use Daedelus\Support\Filters;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class Flexible extends AbstractGroup implements Field
{
    use WithButton, WithMinMax;

    /** @var Layout[] */
    protected array $layouts = [];

    /**
     * @param callable $callback
     * @return static
     */
    public function onLayoutTitle(callable $callback): static
    {
        Filters::add('acf/fields/flexible_content/layout_title/key=' . $this->key, $callback, 10, 4 );

        return $this;
    }

    /**
     * @param string $label
     * @param Closure $closure
     * @param string|null $name
     * @param string|null $key
     * @return static
     */
    public function layout(string $label, Closure $closure, string|null $name = null, string|null $key = null): static
    {
        if ( $name === null ) {
            $name = $label;
        }

        if ( $key === null ) {
            $key = $name;
        }

        $layout = new Layout( $label, $name, $this->key . '_' . $key );

        $this->addLayout( $layout );

        $closure( $layout );

        return $this;
    }

    /**
     * @param Layout $layout
     * @return static
     */
    public function addLayout(Layout $layout): static
    {
        $this->layouts[] = $layout;

        return $this;
    }

	/**
	 * @param array $layouts
	 *
	 * @return static
	 */
	public function layouts(array $layouts): static
	{
		$layouts = array_filter( $layouts, fn ( $layout ) => $layout instanceof Layout );

		foreach ( $layouts as $layout ) {
			$this->addLayout( $layout );
		}

		return $this;
	}

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::flexible, [
            'layouts' => array_map( fn ( Layout $layout ) => $layout->prepareToExport( $this->key )->toArray(), $this->layouts ),
            'button_label' => $this->button,
            'min' => $this->min,
            'max' => $this->max,
        ] );
    }
}