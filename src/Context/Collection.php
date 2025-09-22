<?php

/**
 * @file
 * Contains \Phrender\Context\Collection
 */

namespace Phrender\Context;

use Interop\Output\Context;

/**
 * Collection of contexts
 *
 * @package Phrender\Context
 */
class Collection
	implements Context
{
	/**
	 * @var Context[]
	 */
	protected array $contexts = [];

	public function __construct(Context ...$contexts)
	{
		foreach ($contexts as $context) {
			$this->add($context);
		}
	}

	/**
	 * Add a context to the collection
	 */
	public function add(Context $context): void
	{
		$this->contexts[spl_object_hash($context)] = $context;
	}

	/**
	 * Remove a context from the collection
	 */
	public function remove(Context $context): void
	{
		if (isset($this->contexts[$hash = spl_object_hash($context)])) {
			unset($this->contexts[$hash]);
		}
	}

	/**
	 * Determine if the collection has the context
	 */
	public function has(Context $context): bool
	{
		return isset($this->contexts[spl_object_hash($context)]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function accepts(string $name): bool
	{
		$accepts = false;
		foreach ($this->contexts as $context) {
			$accepts |= $context->accepts($name);
		}

		return (bool)$accepts;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @return mixed[]
	 */
	public function provide(string $name): array
	{
		if (empty($name)) {
			return [];
		}

		return array_reduce(
			$this->contexts,
			fn($carry, $context): array => array_merge($carry, $context->provide($name)),
			[]
		);
	}
}