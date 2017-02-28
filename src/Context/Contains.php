<?php

/**
 * @file
 * Contains \Phrender\Context\Contains
 */
namespace Phrender\Context;

/**
 * Provides a generic matcher for template data
 *
 * @package Phrender\Context
 */
class Contains
	implements \Interop\Output\Context
{
	use SearchesForNeedleInHaystack;

	/**
	 * Returns whether or not the needle is in the haystack
	 *
	 * @param string $haystack
	 * @return bool
	 */
	private function match($haystack)
	{
		return stripos($haystack, $this->needle) !== false;
	}
}
