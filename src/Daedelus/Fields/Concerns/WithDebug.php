<?php
namespace Daedelus\Fields\Concerns;

/**
 * @package Daedelus\Fields
 * @author Anthony Pauwels <anthony@straylightagency.be>
 */
trait WithDebug
{
	/**
	 * Dump and Debug
	 *
	 * @return void
	 */
	public function dd(): void
	{
		if ( function_exists('dd') ) {
			dd( $this->toArray() );
		} else {
			var_dump( $this->toArray() );
			exit;
		}
	}
}