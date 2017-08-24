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
	 * testDummy
	 *
	 * @since 2.0.0
	 */

	public function testDummy()
	{
		/* setup */

		$wording = new Wording();
		$wording->init();

		/* actual */

		$actual = $wording->get('colon');

		/* compare */

		$this->assertString($actual);
	}
}
