<?php

/**
 * @file
 * Contains Phrender\Template\Factory
 */

namespace Phrender\Template;

use Interop\Output\Context;
use Interop\Output\Exception\TemplateNotFound;
use Phrender\Context\Any;

/**
 * Template for rendering PHP
 *
 * @package Phrender\Template
 */
class Template
	implements \Interop\Output\Template
{
	protected ?Context $context = null;

	/**
	 * @var mixed[]
	 */
	protected array $data = [];

	public function __construct(protected string $file, protected Factory $factory)
	{
	}

	/**
	 * {@inheritdoc}
	 */
	public function name(): string
	{
		return $this->file;
	}

	/**
	 * {@inheritdoc}
	 */
	public function render(Context $context): string
	{
		$this->context = $context;
		$this->data    = $context->provide($this->file);

		ob_start();

		require $this->file;

		$this->context = null;

		return  ob_get_clean() ?: '';
	}

	/**
	 * Returns the value from the given name or null
	 *
	 * @param string $name
	 *
	 * @return mixed|null
	 */
	public function __get($name)
	{
		return $this->data[$name] ?? null;
	}

	/**
	 * Render a partial template with the given data using the instantiated factory
	 *
	 * @param mixed[] $data
	 */
	public function partial(string $template, ?array $data = []): string
	{
		try {
			return $this->factory->load($template)->render(new Any(array_merge($this->data, $data ?? [])));
		}
		catch (TemplateNotFound) {
			return '';
		}
	}
}