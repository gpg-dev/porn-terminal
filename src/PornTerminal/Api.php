<?php
namespace PornTerminal;

use Closure;
use function array_keys;
use function array_rand;
use function file_get_contents;
use function implode;
use function in_array;
use function json_decode;

/**
 * parent class to provide the api
 *
 * @since 2.0.0
 *
 * @package PornTerminal
 * @category Api
 * @author Henry Ruhs
 */

class Api
{
	/**
	 * array of the provider
	 *
	 * @var array
	 */

	protected $_providerArray;

	/**
	 * array of the endpoint
	 *
	 * @var array
	 */

	protected $_endpointArray;

	/**
	 * init the class
	 *
	 * @since 2.0.0
	 */

	public function init() : void
	{
		$content = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'provider.json');
		$this->_providerArray = json_decode($content, true);
	}

	/**
	 * get the provider array
	 *
	 * @since 2.0.0
	 *
	 * @return array
	 */

	public function getProviderArray() : array
	{
		return $this->_providerArray;
	}

	/**
	 * get the provider array keys
	 *
	 * @since 2.0.0
	 *
	 * @return array
	 */

	public function getProviderArrayKeys() : array
	{
		return array_keys($this->_providerArray);
	}

	/**
	 * get the provider list
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */

	public function getProviderList() : string
	{
		return implode(', ', $this->getProviderArrayKeys());
	}

	/**
	 * get the default provider
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */

	public function getProviderDefault() : string
	{
		return array_rand($this->_providerArray);
	}

	/**
	 * has the provider
	 *
	 * @since 2.0.0
	 *
	 * @return Closure
	 */

	public function hasProvider() : Closure
	{
		return function ($provider)
		{
			return in_array($provider, $this->getProviderArrayKeys());
		};
	}

	/**
	 * get the endpoint array
	 *
	 * @since 2.0.0
	 *
	 * @return array
	 */

	public function getEndpointArray() : array
	{
		$providerArray = $this->getProviderArray();
		$endpointArray = [];

		/* process provider */

		foreach ($providerArray as $providerValue)
		{
			foreach ($providerValue['endpoint'] as $endpointKey => $endpointValue)
			{
				$endpointArray[$endpointKey] = $endpointKey;
			}
		}
		return $endpointArray;
	}

	/**
	 * get the endpoint list
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */

	public function getEndpointList() : string
	{
		return implode(', ', $this->getEndpointArray());
	}

	/**
	 * get the default endpoint
	 *
	 * @since 2.0.0
	 *
	 * @return string
	 */

	public function getEndpointDefault() : string
	{
		return 'videos';
	}

	/**
	 * has the endpoint
	 *
	 * @since 2.0.0
	 *
	 * @return Closure
	 */

	public function hasEndpoint() : Closure
	{
		return function ($endpoint)
		{
			return in_array($endpoint, $this->getEndpointArray());
		};
	}
}
