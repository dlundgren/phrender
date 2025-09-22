<?php
namespace Phrender\Template;

use PHPUnit\Framework\TestCase;
use Phrender\Context\Any;

class TemplateTest
	extends TestCase
{
	public function testRenderReturnsData()
	{
		$f = $this->createMock(Factory::class);

		$t = new Template(TEST_FILES_PATH . '/tests/basic-render.php', $f);

		self::assertEquals('kakaw', $t->render(new Any(['test' => 'kakaw'])));
	}

	public function testPartial()
	{
		$path = TEST_FILES_PATH . '/tests/';
		$f = new Factory([$path]);

		$t = new Template("{$path}/partial-render.php", $f);

		self::assertEquals('kakawkakaw', $t->render(new Any(['test' => 'kakaw'])));
	}

	public function testPartialReturnsEmpty()
	{
		$path = TEST_FILES_PATH . '/tests/';
		$f = new Factory([$path]);

		$t = new Template("{$path}/partial-render-none.php", $f);

		self::assertEquals('kakaw', $t->render(new Any(['test' => 'kakaw'])));
	}
}