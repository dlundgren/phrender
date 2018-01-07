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
	const DEFAULT_EXT = 'php';

	/**
	 * List of paths to search for the templates
	 *
	 * @var array
	 */
	private $paths = [];

	/**
	 * The file extension to use for the files
	 *
	 * @var string
	 */
	private $ext = self::DEFAULT_EXT;

	public function __construct($paths = [], $ext = self::DEFAULT_EXT)
	{
		$this->paths = $paths;
		$this->ext   = $ext;
	}

	/**
	 * {@inheritdoc}
	 */
	public function load($template)
	{
		foreach ($this->paths as $path) {
			if (file_exists($file = "{$path}/{$template}.{$this->ext}")) {
				return new Template($file, $this);
			}
		}

		throw new TemplateNotFound($template);
	}

}