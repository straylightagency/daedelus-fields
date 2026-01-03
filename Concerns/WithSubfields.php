<?php
namespace Daedelus\Fields\Concerns;

use Daedelus\Fields\Contracts\Field;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithSubfields
{
    /** @var array */
    protected array $fields = [];

	/**
	 * @param Field $field
	 *
	 * @return static
	 */
    public function addField(Field $field): static
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * @param array $fields
     *
     * @return static
     */
    public function appendFields(array $fields): static
    {
		$fields = array_filter( $fields, fn ( $field ) => $field instanceof Field );

        foreach ( $fields as $field ) {
            $this->addField( $field );
        }

        return $this;
    }

	/**
	 * @param array $fields
	 *
	 * @return static
	 */
	public function prependFields(array $fields): static
	{
		$this->fields = array_reverse( $this->fields );

		$this->appendFields( array_reverse( $fields ) );

		$this->fields = array_reverse( $this->fields );

		return $this;
	}

	/**
	 * Alias to appendFields
	 *
	 * @param array $fields
	 *
	 * @return static
	 */
	public function fields(array $fields): static
	{
		return $this->appendFields( $fields );
	}
}