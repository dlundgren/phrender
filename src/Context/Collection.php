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
	 * @var \SplObjectStorage
	 */
	private $storage;

	/**
	 * Collection constructor.
	 */
	public function __construct()
	{
		$this->storage = [];
	}

	/**
	 * Add a context to the collection
	 *
	 * @param Context $context
	 */
	public function add(Context $context)
	{
		$this->storage[spl_object_hash($context)] = $context;
	}

	/**
	 * Remove a context from the collection
	 *
	 * @param Context $context
	 */
	public function remove(Context $context)
	{
		if (isset($this->storage[$hash = spl_object_hash($context)])) {
			unset($this->storage[$hash]);
		}
	}

	/**
	 * Determine if the collection has the context
	 * @param Context $context
	 * @return bool
	 */
	public function has(Context $context)
	{
		return isset($this->storage[spl_object_hash($context)]);
	}

	/**
	 * {@inheritdoc}
	 */
	public function accepts($template)
	{
		$accepts = false;
		foreach($this->storage as $context) {
			$accepts |= $context->accepts($template);
		}

		return $accepts ? true : false;
	}

	/**
	 * {@inheritdoc}
	 */
	public function provide($template)
	{
		if (empty($template)) {
			return [];
		}

		return array_reduce($this->storage, function ($carry, $context) use ($template) {
			return array_merge($carry ?: [], $context->provide($template));
		});
	}
}