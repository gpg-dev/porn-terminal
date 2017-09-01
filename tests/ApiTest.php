<?php
namespace PornTerminal\Tests;

use PornTerminal\Api;

/**
 * ApiTest
 *
 * @since 2.0.0
 *
 * @package PornTerminal
 * @category Tests
 * @author Henry Ruhs
 */

class ApiTest extends TestCaseAbstract
{
	/**
	 * testGetProviderArray
	 *
	 * @since 2.0.0
	 */

	public function testGetProviderArray()
	{
		/* setup */

		$api = new Api();
		$api->init();

		/* actual */

		$actual = $api->getProviderArray();

		/* compare */

		$this->assertArrayHasKey('porn.com', $actual);
	}

	/**
	 * testGetEndpointArray
	 *
	 * @since 2.0.0
	 */

	public function testGetEndpointArray()
	{
		/* setup */

		$api = new Api();
		$api->init();

		/* actual */

		$actual = $api->getEndpointArray();

		/* compare */

		$this->assertArrayHasKey('videos', $actual);
	}
}
