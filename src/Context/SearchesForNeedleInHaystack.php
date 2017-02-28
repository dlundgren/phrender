<?php

namespace Phrender\Context;

trait SearchesForNeedleInHaystack
{
	/**
	 * @var string
	 */
	private $needle;

	/**
	 * @var array
	 */
	private $data;

	/**
	 * Generic constructor for needle
	 *
	 * @param string $needle
	 * @param array  $data
	 */
	public function __construct($needle, array $data = [])
	{
		$this->needle = $needle;
		$this->data   = $data;
	}

	/**
	 * {@inheritdoc}
	 */
	public function accepts($template)
	{
		if (is_string($template)) {
			return $this->match($template);
		}

		throw new \InvalidArgumentException("Template passed in must be a string");
	}

	/**
	 * {@inheritdoc}
	 */
	public function provide($template)
	{
		return $this->match($template)
			? $this->data
			: [];
	}
}