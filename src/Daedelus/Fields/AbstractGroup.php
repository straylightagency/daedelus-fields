<?php
namespace Daedelus\Fields;

use Daedelus\Fields\Contracts\Group;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
abstract class AbstractGroup extends AbstractField implements Group
{
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
            'sub_fields' => [],
            'type' => $type,
            'instructions' => $this->instructions,
            'required' => $this->required,
            'conditional_logic' => empty( $this->conditionalLogic ) ? 0 : $this->conditionalLogic,
            'wrapper' => $this->wrapperAttributes,
            'default_value' => $this->default,
        ], Builder::getConfigOf( $type ), $more_params );
    }

    /**
     * Return the generated group key
     *
     * @return string
     */
    protected function getKey(): string
    {
        return '_acf_group_' . $this->key;
    }
}