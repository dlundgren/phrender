<?php

/**
 * @file
 * Contains \Phrender\Context\Match
 */
namespace Phrender\Context;

/**
 * Provides a regex pattern matcher for template data
 *
 * @package Phrender\Context
 */
class Match
	implements \Interop\Output\Context
{
	use SearchesForNeedleInHaystack;

	/**
	 * Performs the Regex matching
	 *
	 * @param string $haystack The haystack to perform the regex on
	 * @return bool
	 */
	private function match($haystack)
	{
		return preg_match($this->needle, $haystack) === 1;
	}
}
