<?php
namespace Phrender\Template;

use Interop\Output\Exception\TemplateNotFound;
use PHPUnit\Framework\TestCase;

class FactoryTest
	extends TestCase
{
	public function testLoadThrowsException()
	{
		$this->expectException(TemplateNotFound::class);
		(new Factory())->load('kakaw');
	}

	public function testLoadReturnsLayoutsDefault()
	{
		$f = new Factory([TEST_FILES_PATH . '/layouts', TEST_FILES_PATH . '/views']);
		self::assertEquals(TEST_FILES_PATH .'/layouts/default.php', $f->load('default')->file());
	}

	public function testLoadReturnsViewsIndex()
	{
		$f = new Factory([TEST_FILES_PATH . '/layouts', TEST_FILES_PATH . '/views']);
		self::assertEquals(TEST_FILES_PATH .'/views/index.php', $f->load('index')->file());
	}

	public function testLoadReturnsAlternateFileExtension()
	{
		$f = new Factory([TEST_FILES_PATH . '/layouts', TEST_FILES_PATH . '/views'], 'phtml');
		self::assertEquals(TEST_FILES_PATH .'/views/index.phtml', $f->load('index')->file());
	}
}