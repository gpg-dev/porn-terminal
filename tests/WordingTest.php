<?php
namespace PornTerminal\Tests;

use PornTerminal\Wording;

/**
 * WordingTest
 *
 * @since 2.0.0
 *
 * @package PornTerminal
 * @category Tests
 * @author Henry Ruhs
 */

class WordingTest extends TestCaseAbstract
{
	/**
	 * testGet
	 *
	 * @since 2.0.0
	 */

	public function testGet()
	{
		/* setup */

		$wording = new Wording();
		$wording->init();

		/* expect and actual */

		$expect = '.';
		$actual = $wording->get('point');

		/* compare */

		$this->assertEquals($expect, $actual);
	}
}
