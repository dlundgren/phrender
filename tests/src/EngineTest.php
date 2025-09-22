<?php

namespace Phrender;

use PHPUnit\Framework\TestCase;
use Phrender\Context\Any;
use Phrender\Context\Collection;
use Phrender\Template\Factory;

class EngineTest
	extends TestCase
{
	private function buildBasicEngine()
	{
		return new Engine(new Factory([TEST_FILES_PATH . '/tests']), new Collection());
	}

	public function testConstructor()
	{
		$f = new Factory();
		$c = new Any();
		$e = new Engine($f, $c);

		self::assertSame($f, $e->factory());
		self::assertTrue($e->context()->has($c));
	}

	public function testUseContextOverridesExistingContext()
	{
		$e = $this->buildBasicEngine();
		$ca = new Any();
		$e->useContext($cb = new Any());
		self::assertFalse($e->context()->has($ca));
		$e->useContext($ca);
		self::assertTrue($e->context()->has($ca));
	}

	public function testUseFactoryOverridesExistingFactory()
	{
		$e = $this->buildBasicEngine();
		$f = new Factory();
		self::assertNotSame($f, $e->factory());
		$e->useFactory($f);
		self::assertSame($f, $e->factory());
	}

	public function testRender()
	{
		$e = $this->buildBasicEngine();
		$e->context()->add(new Any(['test' => 'woot']));

		self::assertEquals('cool', $e->render('basic-render', ['test' => 'cool']));
	}
}