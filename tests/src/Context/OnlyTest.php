<?php

namespace Phrender\Context;

use PHPUnit\Framework\TestCase;

class OnlyTest
	extends TestCase
{
	public function testAcceptsReturnsTrue()
	{
		self::assertTrue((new Only('test1'))->accepts('test1'));
	}

	public function testAcceptsReturnsFals()
	{
		self::assertFalse((new Only('test2'))->accepts('test1'));
	}

	public function testProvideReturnsEmpty()
	{
		$data = [
			'test1' => 'lala'
		];
		self::assertEmpty((new Only('test2', $data))->provide('test1'));
	}
	public function testProvideReturnsArrayData()
	{
		$data = [
			'test1' => 'lala'
		];
		self::assertEquals($data, (new Only('test2', $data))->provide('test2'));
	}
}