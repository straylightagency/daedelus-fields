<?php
namespace Daedelus\Fields\Contracts;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
interface Field
{
    /**
     * @return array
     */
    function toArray(): array;
}