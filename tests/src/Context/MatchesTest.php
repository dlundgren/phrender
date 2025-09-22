<?php

namespace Phrender\Context;

use PHPUnit\Framework\TestCase;

class MatchesTest
	extends TestCase
{
	public function testAcceptsReturnsTrue()
	{
		self::assertTrue((new Matches('/^test[0-9]$/'))->accepts('test1'));
	}

	public function testAcceptsReturnsFalse()
	{
		self::assertFalse((new Matches('/^mine$/'))->accepts('test1'));
	}

	public function testProvideReturnsEmpty()
	{
		$data = [
			'test1' => 'lala'
		];
		self::assertEmpty((new Matches('/^mine$/', $data))->provide('test1'));
	}
	public function testProvideReturnsArrayData()
	{
		$data = [
			'test1' => 'lala'
		];
		self::assertEquals($data, (new Matches('/^test[0-9]$/', $data))->provide('test2'));
	}
}