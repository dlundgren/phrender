<?php

/**
 * @file
 * Contains Phrender\Engine
 */

namespace Phrender;

use Interop\Output\Context;
use Interop\Output\Template as InteropTemplate;
use Phrender\Context\Any;
use Phrender\Context\Collection;
use Phrender\Template\Factory;

/**
 * The Template rendering engine
 *
 * @package Phrender
 */
class Engine
	implements \Interop\Output\Engine
{
	protected Collection $context;

	protected Factory $factory;

	public function __construct(
		?Factory $factory = null,
		?Context $context = null
	) {
		$this->useContext($context ?? new Collection());
		$this->factory = $factory ?? new Factory();
	}

	/**
	 * Returns the currently used global context
	 */
	public function context(): Collection
	{
		return $this->context;
	}

	/**
	 * Set the global context
	 */
	public function useContext(Context $context): self
	{
		$this->context = ($context instanceof Collection) ? $context : new Collection($context);

		return $this;
	}

	/**
	 * Returns the Template factory in use
	 */
	public function factory(): Factory
	{
		return $this->factory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function useFactory(Factory $factory): self
	{
		$this->factory = $factory;

		return $this;
	}

	/**
	 * {@inheritdoc}
	 *
	 * @param Context|mixed[]|null $data
	 */
	public function render(string $template, Context|array|null $data = null): string
	{
		$data = $data instanceof Context ? $data : new Any($data ?? []);

		$this->context->add($data);

		$output = $this->loadTemplate($template)->render($this->context);

		$this->context->remove($data);

		return $output;
	}

	protected function loadTemplate(string $template): InteropTemplate
	{
		return $this->factory->load($template);
	}
}