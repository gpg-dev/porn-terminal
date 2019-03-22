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

	public function testGetProviderArray() : void
	{
		/* setup */

		$api = new Api();
		$api->init();

		/* actual */

		$actualArray = $api->getProviderArray();

		/* compare */

		$this->assertArrayHasKey('porn.com', $actualArray);
	}

	/**
	 * testGetProviderList
	 *
	 * @since 2.0.0
	 */

	public function testGetProviderList() : void
	{
		/* setup */

		$api = new Api();
		$api->init();

		/* actual */

		$actual = $api->getProviderList();

		/* compare */

		$this->assertIsString($actual);
	}

	/**
	 * testGetEndpointArray
	 *
	 * @since 2.0.0
	 */

	public function testGetEndpointArray() : void
	{
		/* setup */

		$api = new Api();
		$api->init();

		/* actual */

		$actualArray = $api->getEndpointArray();

		/* compare */

		$this->assertArrayHasKey('videos', $actualArray);
	}

	/**
	 * testGetEndpointList
	 *
	 * @since 2.0.0
	 */

	public function testGetEndpointList() : void
	{
		/* setup */

		$api = new Api();
		$api->init();

		/* actual */

		$actual = $api->getEndpointList();

		/* compare */

		$this->assertIsString($actual);
	}
}
