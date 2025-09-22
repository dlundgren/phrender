<?php

/**
 * @file
 * Contains Phrender\Template\Factory
 */

namespace Phrender\Template;

use Interop\Output\Template as InteropTemplate;
use Phrender\Exception\TemplateNotFound;

/**
 * Template Factory for templates
 *
 * @package Phrender\Template
 */
class Factory
{
	const DEFAULT_EXT = 'php';

	/**
	 * @param string[] $paths
	 */
	public function __construct(
		protected array  $paths = [],
		protected string $ext = self::DEFAULT_EXT
	) {
	}

	public function load(string $template): InteropTemplate
	{
		foreach ($this->paths as $path) {
			if (file_exists($file = "{$path}/{$template}.{$this->ext}")) {
				return $this->create($file);
			}
		}

		throw new TemplateNotFound($template);
	}

	public function create(string $file): InteropTemplate
	{
		return new Template($file, $this);
	}
}