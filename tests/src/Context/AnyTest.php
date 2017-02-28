<?php

namespace Phrender\Context;

use PHPUnit\Framework\TestCase;

class AnyTest
	extends TestCase
{
	public function testAccepts()
	{
		self::assertTrue((new Any())->accepts('asdf'));
	}

	public function testProvide()
	{
		$data = [
			'test1' => 'lala'
		];
		self::assertEquals($data, (new Any($data))->provide('ack'));
	}
}