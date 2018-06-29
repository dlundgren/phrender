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
	protected $paths = [];

	/**
	 * The file extension to use for the files
	 *
	 * @var string
	 */
	protected $ext = self::DEFAULT_EXT;

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
				return $this->newTemplate($file);
			}
		}

		throw new TemplateNotFound($template);
	}

	/**
	 * @param $file
	 * @return Template The new template
	 */
	protected function newTemplate($file)
	{
		return new Template($file, $this);
	}

}