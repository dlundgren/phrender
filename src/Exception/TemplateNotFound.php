<?php

/**
 * @file
 * Contains Phrender\Exception\TemplateNotFound
 */

namespace Phrender\Exception;

/**
 * Exception for when the template cannot be found
 *
 * @package Phrender\Exception
 */
class TemplateNotFound
	extends \Exception
	implements \Interop\Output\Exception\TemplateNotFound
{
	public function __construct(string $template)
	{
		$this->message = "Template not found: {$template}";
	}
}