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
	 * List of data for this context
	 *
	 * @var array
	 */
	private $data;

	/**
	 * @var string
	 */
	private $match;

	/**
	 * @param array $data
	 */
	public function __construct($name, array $data = [])
	{
		$this->match = $name;
		$this->data = $data;
	}

	/**
	 * Always returns true
	 *
	 * {@inheritdoc}
	 */
	public function accepts($template)
	{
		return $this->match === $template;
	}

	/**
	 * {@inheritdoc}
	 */
	public function provide($template)
	{
		if ($this->accepts($template)) {
			return $this->data;
		}

		return [];
	}
}
