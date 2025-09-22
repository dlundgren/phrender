<?php

/**
 * @file
 * Contains \Phrender\Context\SearchesForNeedleInHaystack
 */

namespace Phrender\Context;

trait SearchesForNeedleInHaystack
{
	/**
	 * Generic constructor for needle
	 *
	 * @param mixed[] $data
	 */
	public function __construct(protected string $needle, protected array $data = [])
	{
	}

	/**
	 * {@inheritdoc}
	 */
	public function accepts(string $name): bool
	{
		return $this->match($name);
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return mixed[]
	 */
	public function provide(string $name): array
	{
		return $this->match($name)
			? $this->data
			: [];
	}
}