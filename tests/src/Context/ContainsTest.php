<?php

namespace Phrender\Context;

use PHPUnit\Framework\TestCase;

class ContainsTest
	extends TestCase
{
	public function testAcceptsReturnsTrue()
	{
		self::assertTrue((new Contains('st'))->accepts('test1'));
	}

	public function testAcceptsReturnsFalse()
	{
		self::assertFalse((new Contains('t2'))->accepts('test1'));
	}

	public function testProvideReturnsEmpty()
	{
		$data = [
			'test1' => 'lala'
		];
		self::assertEmpty((new Contains('t2', $data))->provide('test1'));
	}
	public function testProvideReturnsArrayData()
	{
		$data = [
			'test1' => 'lala'
		];
		self::assertEquals($data, (new Contains('t2', $data))->provide('test2'));
	}
}