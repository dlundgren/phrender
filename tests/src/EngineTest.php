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

		self::assertSame($f, $e->templateFactory());
		self::assertSame($c, $e->context());
	}

	public function testUseContextOverridesExistingContext()
	{
		$e = $this->buildBasicEngine();
		$c = new Any();
		self::assertNotSame($c, $e->context());
		$e->useContext($c);
		self::assertSame($c, $e->context());
	}

	public function testUseTemplateFactoryOverridesExistingContext()
	{
		$e = $this->buildBasicEngine();
		$f = new Factory();
		self::assertNotSame($f, $e->templateFactory());
		$e->useTemplateFactory($f);
		self::assertSame($f, $e->templateFactory());
	}

	public function testRender()
	{
		$e = $this->buildBasicEngine();
		$e->context()->add(new Any(['test' => 'woot']));

		self::assertEquals('cool', $e->render('basic-render', ['test' => 'cool']));
	}
}