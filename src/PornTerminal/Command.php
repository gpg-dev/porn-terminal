<?php
namespace PornTerminal;

use Commando;

/**
 * parent class to provide the command
 *
 * @since 2.0.0
 *
 * @package PornTerminal
 * @category Command
 * @author Henry Ruhs
 */

class Command extends Commando\Command
{
	/**
	 * instance of the api class
	 *
	 * @var Api
	 */

	protected $_api;

	/**
	 * instance of the wording class
	 *
	 * @var Wording
	 */

	protected $_wording;

	/**
	 * constructor of the class
	 *
	 * @since 2.0.0
	 *
	 * @param Api $api instance of the api class
	 * @param Wording $wording instance of the wording class
	 */

	public function __construct(Api $api, Wording $wording)
	{
		parent::__construct();
		$this->_api = $api;
		$this->_wording = $wording;
	}

	/**
	 * init the class
	 *
	 * @since 2.0.0
	 *
	 * @return Commando\Command
	 */

	public function init() : Commando\Command
	{
		return $this
			->option('P')
			->aka('api-provider')
			->describe($this->_wording->get('api_provider') . $this->_wording->get('colon') . ' ' . $this->_api->getProviderList())
			->default($this->_api->getProviderDefault())
			->must($this->_api->hasProvider())
			->required()
			->option('E')
			->aka('api-endpoint')
			->describe($this->_wording->get('api_endpoint') . $this->_wording->get('colon') . ' ' . $this->_api->getEndpointList())
			->default($this->_api->getEndpointDefault())
			->must($this->_api->hasEndpoint())
			->required()
			->option('Q')
			->aka('api-query')
			->describe($this->_wording->get('api_query') . $this->_wording->get('point'))
			->option('T')
			->aka('api-timeout')
			->describe($this->_wording->get('api_timeout') . $this->_wording->get('point'))
			->default(2)
			->option('R')
			->aka('image-resize')
			->describe($this->_wording->get('image_resize') . $this->_wording->get('point'))
			->default(0.5)
			->option('I')
			->aka('image-invert')
			->describe($this->_wording->get('image_invert') . $this->_wording->get('point'))
			->boolean()
			->option('W')
			->aka('image-weight')
			->describe($this->_wording->get('image_weight') . $this->_wording->get('point'))
			->default(1)
			->option('D')
			->aka('image-dither')
			->describe($this->_wording->get('image_dither') . $this->_wording->get('point'))
			->default(1)
			->boolean()
			->option('G')
			->aka('image-grayscale')
			->describe($this->_wording->get('image_grayscale') . $this->_wording->get('point'))
			->boolean()
			->option('M')
			->default(1)
			->aka('image-metadata')
			->describe($this->_wording->get('image_metadata') . $this->_wording->get('point'))
			->boolean()
			->option('O')
			->aka('open-browser')
			->describe($this->_wording->get('open_browser') . $this->_wording->get('point'))
			->boolean();
	}
}
