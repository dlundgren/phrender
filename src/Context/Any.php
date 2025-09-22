<?php

/**
 * @file
 * Contains \Phrender\Context\Any
 */

namespace Phrender\Context;

use Interop\Output\Context;

/**
 * Data for any template
 *
 * @package Phrender\Context
 */
class Any
	implements Context
{
	/**
	 * @param mixed[] $data
	 */
	public function __construct(protected array $data = [])
	{
	}

	/**
	 * Always returns true
	 *
	 * {@inheritdoc}
	 */
	public function accepts(string $name): bool
	{
		return true;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return mixed[]
	 */
	public function provide(string $name): array
	{
		return $this->data;
	}
}
