<?php

/**
 * @file
 * Contains \Phrender\Context\Only
 */

namespace Phrender\Context;

use Interop\Output\Context;

/**
 * Data for only the one template
 *
 * @package Phrender\Context
 */
class Only
	implements Context
{
	/**
	 * @param mixed[] $data
	 */
	public function __construct(protected string $name, protected array $data = [])
	{
	}

	/**
	 * {@inheritdoc}
	 */
	public function accepts(string $name): bool
	{
		return $this->name === $name;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return mixed[]
	 */
	public function provide(string $name): array
	{
		return $this->accepts($name)
			? $this->data
			: [];
	}
}
