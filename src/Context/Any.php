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
	 * List of data for this context
	 *
	 * @var array
	 */
	private $data;

	/**
	 * @param array $data
	 */
	public function __construct(array $data = [])
	{
		$this->data = $data;
	}

	/**
	 * Always returns true
	 *
	 * {@inheritdoc}
	 */
	public function accepts($template)
	{
		return true;
	}

	/**
	 * {@inheritdoc}
	 */
	public function provide($template)
	{
		return $this->data;
	}
}
