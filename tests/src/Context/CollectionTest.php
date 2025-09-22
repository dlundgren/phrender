<?php

namespace Phrender\Context;

use PHPUnit\Framework\TestCase;

class CollectionTest
	extends TestCase
{
	public function testAcceptsReturnsFalse()
	{
		self::assertFalse((new Collection())->accepts('test'));
	}

	public function testAcceptsReturnsTrue()
	{
		$c = new Collection();
		$c->add(new Any());
		self::assertTrue($c->accepts('test'));
	}

	private function buildCollection()
	{
		$c = new Collection();
		$c->add(new Only('tester', ['test1' => 'kakaw']));

		return $c;
	}
	public function testProvideReturnsEmptyWithNoTemplate()
	{
		self::assertEmpty((new Collection())->provide(''));
	}

	public function testProvideReturnsEmpty()
	{
		$c = $this->buildCollection();
		self::assertEmpty($c->provide('phrend'));
	}

	public function testProvideReturnsData()
	{
		$c = $this->buildCollection();
		self::assertEquals(['test1' => 'kakaw'], $c->provide('tester'));
	}

	public function testProvideReturnsDataFromMultipleContexts()
	{
		$c = $this->buildCollection();
		$c->add(new Any(['test2' => 'woot']));

		self::assertEquals(['test2' => 'woot'], $c->provide('phrend'));
		self::assertEquals(['test1' => 'kakaw', 'test2' => 'woot'], $c->provide('tester'));
	}

	public function testHasReturnsFalse()
	{
		$any = new Any();
		self::assertFalse((new Collection())->has($any));
	}

	public function testHasReturnsTrue()
	{
		$c = $this->buildCollection();
		$c->add($any1 = new Any());
		$c->add($any2 = new Any());
		self::assertTrue($c->has($any1));
		self::assertTrue($c->has($any2));
	}

	public function testRemove()
	{
		$c = $this->buildCollection();
		$c->add($any1 = new Any());
		$c->add($any2 = new Any());
		$c->remove($any1);
		self::assertFalse($c->has($any1));
		self::assertTrue($c->has($any2));
	}

	public function testConstructorNoArguments()
	{
		$c = new Collection();
		self::assertFalse($c->has(new Any()));
	}

	public function testConstructorVariadic()
	{
		$c = new Collection($a1 = new Any());
		self::assertTrue($c->has($a1));
	}
}