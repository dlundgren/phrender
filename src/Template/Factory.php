<?php

/**
 * @file
 * Contains Phrender\Template\Factory
 */

namespace Phrender\Template;

use Interop\Output\TemplateFactory;
use Phrender\Exception\TemplateNotFound;

/**
 * Template Factory for templates
 *
 * @package Phrender\Template
 */
class Factory
	implements TemplateFactory
{
	/**
	 * List of paths to search for the templates
	 *
	 * @var array
	 */
	private $paths = [];

	public function __construct($paths = [])
	{
		$this->paths = $paths;
	}

	/**
	 * {@inheritdoc}
	 */
	public function load($template)
	{
		foreach ($this->paths as $path) {
			if (file_exists($file = "{$path}/{$template}.php")) {
				return new Template($file, $this);
			}
		}

		throw new TemplateNotFound($template);
	}

}