<?php

/**
 * @file
 * Contains Phrender\Template\Factory
 */

namespace Phrender\Template;

use Interop\Output\Context as InteropContext;
use Interop\Output\TemplateFactory;
use Phrender\Context;
use Interop\Output\Exception\TemplateNotFound;

/**
 * Template for rendering PHP
 *
 * @package Phrender\Template
 */
class Template
	implements \Interop\Output\Template
{
	/**
	 * The Factory for partials
	 *
	 * @var Factory
	 */
	private $factory;

	/**
	 * The file to render
	 *
	 * @var string
	 */
	private $file;

	public function __construct($file, TemplateFactory $factory)
	{
		$this->factory = $factory;
		$this->file    = $file;
	}

	/**
	 * {@inheritdoc}
	 */
	public function file()
	{
		return $this->file;
	}

	/**
	 * {@inheritdoc}
	 */
	public function render(InteropContext $context)
	{
		$this->data    = $context->provide($this->file);

		ob_start();

		require $this->file;

		return ob_get_clean();
	}

	/**
	 * Returns the value from the given name or null
	 *
	 * @param string $name
	 * @return mixed|null
	 */
	public function __get($name)
	{
		return isset($this->data[$name]) ? $this->data[$name] : null;
	}

	/**
	 * Render a partial template with the given data using the instantiated factory
	 *
	 * @TODO should probably be using the engine instead?
	 *
	 * @param string     $template
	 * @param array|null $data
	 * @return bool|string
	 */
	public function partial($template, $data = [])
	{
		try {
			return $this->factory->load($template)->render(new Context\Any(array_merge($this->data, $data)));
		}
		catch (TemplateNotFound $e) {
			return '';
		}
	}
}