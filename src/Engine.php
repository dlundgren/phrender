<?php

/**
 * @file
 * Contains Phrender\Engine
 */
namespace Phrender;

use Interop\Output\Context as InteropContext;
use Interop\Output\TemplateFactory;

/**
 * The Template rendering engine
 *
 * @package Phrender
 */
class Engine
	implements \Interop\Output\Engine
{
	/**
	 * @var InteropContext
	 */
	private $context;

	/**
	 * @var TemplateFactory
	 */
	private $factory;

	public function __construct(TemplateFactory $factory = null,InteropContext $context = null)
	{
		$this->context = $context ?: new Context\Collection();
		$this->factory = $factory ?: new Template\Factory();
	}

	/**
	 * {@inheritdoc}
	 */
	public function context()
	{
		return $this->context;
	}

	/**
	 * {@inheritdoc}
	 */
	public function useContext(InteropContext $context)
	{
		$this->context = $context;
	}

	/**
	 * {@inheritdoc}
	 */
	public function templateFactory()
	{
		return $this->factory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function useTemplateFactory(TemplateFactory $templateFactory)
	{
		$this->factory = $templateFactory;
	}

	/**
	 * {@inheritdoc}
	 */
	public function render($template, $data)
	{
		if (!($data instanceof InteropContext)) {
			$data = new Context\Any($data);
		}
		$this->context->add($data);

		$output = $this->factory->load($template)->render($this->context);

		$this->context->remove($data);

		return $output;
	}

}