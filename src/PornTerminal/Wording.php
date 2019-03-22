<?php
namespace PornTerminal;

use function file_get_contents;
use function json_decode;

/**
 * parent class to provide the wording
 *
 * @since 2.0.0
 *
 * @package PornTerminal
 * @category Wording
 * @author Henry Ruhs
 */

class Wording
{
	/**
	 * array of the wording
	 *
	 * @var array
	 */

	protected $_wordingArray;

	/**
	 * init the class
	 *
	 * @since 2.0.0
	 */

	public function init() : void
	{
		$content = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'wording.json');
		$this->_wordingArray = json_decode($content, true);
	}

	/**
	 * get
	 *
	 * @since 2.0.0
	 *
	 * @param string $key
	 *
	 * @return string
	 */

	public function get(string $key = null) : string
	{
		return $this->_wordingArray[$key];
	}
}
