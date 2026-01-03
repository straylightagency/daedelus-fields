<?php
namespace Daedelus\Fields\Fields;

use Daedelus\Fields\AbstractField;
use Daedelus\Fields\Concerns\WithMultiple;
use Daedelus\Fields\Concerns\WithNullable;
use Daedelus\Fields\Fields;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
class User extends AbstractField
{
    use WithNullable, WithMultiple;

    /** @var array */
    protected array $roles = [];

    /**
     * @param array $roles
     * @return static
     */
    public function roles(array $roles): User
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->export( Fields::user, [
            'role' => $this->roles,
            'allow_null' => (int) $this->nullable,
            'multiple' => (int) $this->multiple,
        ] );
    }
}