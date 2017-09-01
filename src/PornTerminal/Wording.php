<?php
namespace PornTerminal;

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

	public function init()
	{
		$content = file_get_contents('wording.json');
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
