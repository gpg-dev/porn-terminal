<?php
namespace PornTerminal\Tests;

use PHPUnit;

/**
 * TestCaseAbstract
 *
 * @since 2.0.0
 *
 * @package PornTerminal
 * @category Tests
 * @author Henry Ruhs
 */

abstract class TestCaseAbstract extends PHPUnit\Framework\TestCase
{
	/**
	 * assertString
	 *
	 * @since 2.0.0
	 *
	 * @param string $actual
	 */

	public function assertString($actual = null)
	{
		$this->assertTrue(is_string($actual));
	}
}
