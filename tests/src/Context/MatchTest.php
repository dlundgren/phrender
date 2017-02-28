<?php

namespace Phrender\Context;

use PHPUnit\Framework\TestCase;

class MatchTest
	extends TestCase
{
	public function testAcceptsReturnsTrue()
	{
		self::assertTrue((new Match('/^test[0-9]$/'))->accepts('test1'));
	}

	public function testAcceptsReturnsFalse()
	{
		self::assertFalse((new Match('/^mine$/'))->accepts('test1'));
	}

	public function testProvideReturnsEmpty()
	{
		$data = [
			'test1' => 'lala'
		];
		self::assertEmpty((new Match('/^mine$/', $data))->provide('test1'));
	}
	public function testProvideReturnsArrayData()
	{
		$data = [
			'test1' => 'lala'
		];
		self::assertEquals($data, (new Match('/^test[0-9]$/', $data))->provide('test2'));
	}
}