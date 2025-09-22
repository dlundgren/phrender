<?php

/**
 * @file
 * Contains \Phrender\Context\Matches
 */

namespace Phrender\Context;

use Interop\Output\Context;

/**
 * Provides a regex pattern matcher for template data
 *
 * @package Phrender\Context
 */
class Matches
	implements Context
{
	use SearchesForNeedleInHaystack;

	protected function match(string $haystack): bool
	{
		return preg_match($this->needle, $haystack) === 1;
	}
}
