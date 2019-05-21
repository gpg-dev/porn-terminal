<?php
namespace PornTerminal;

use Commando;
use Exception;
use Pixeler;
use stdClass;
use function array_filter;
use function array_rand;
use function curl_close;
use function curl_errno;
use function curl_error;
use function curl_exec;
use function curl_init;
use function curl_setopt_array;
use function exec;
use function implode;
use function is_array;
use function json_decode;
use function parse_url;

/**
 * parent class for the core
 *
 * @since 2.0.0
 *
 * @package PornTerminal
 * @category Core
 * @author Henry Ruhs
 */

class Core
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
		$this->_api = $api;
		$this->_wording = $wording;
	}

	/**
	 * run
	 *
	 * @since 2.0.0
	 *
	 * @param Commando\Command $command
	 *
	 * @throws Exception
	 *
	 * @return string
	 */

	public function run(Commando\Command $command) : string
	{
		$result = $this->_getResult($command);

		/* collect output */

		$output = $this->_drawImage($command, $result);
		if ($command['image-metadata'])
		{
			$metaArray = $this->_getMetadataArray($result);
			if ($metaArray)
			{
				$output .= implode(PHP_EOL, $metaArray) . PHP_EOL;
			}
		}

		/* open browser */

		if ($command['open-browser'])
		{
			$this->_openBrowser($result);
		}
		return $output;
	}

	/**
	 * get the result
	 *
	 * @since 2.0.0
	 *
	 * @param Commando\Command $command
	 *
	 * @throws Exception
	 *
	 * @return stdClass
	 */

	protected function _getResult(Commando\Command $command) : stdClass
	{
		$content = $this->_fetchContent($command);
		$result = json_decode($content);

		/* map result */

		if ($result->result)
		{
			$result = $result->result;
		}
		if ($result->videos)
		{
			$result = $result->videos;
		}
		if ($result->video)
		{
			$result = $result->video;
		}
		if (!is_array($result))
		{
			$command->error(new Exception($this->_wording->get('no_result')));
		}
		$key = array_rand($result);
		$result = $result[$key];

		/* map result */

		if ($result->video)
		{
			$result = $result->video;
		}
		if ($result->default_thumb)
		{
			$result->thumb = $result->default_thumb;
		}
		return $result;
	}

	/**
	 * fetch the content
	 *
	 * @since 2.0.0
	 *
	 * @param Commando\Command $command
	 *
	 * @throws Exception
	 *
	 * @return string
	 */

	protected function _fetchContent(Commando\Command $command) : string
	{
		$optionArray =
		[
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_URL => $this->_buildUrl($command),
			CURLOPT_TIMEOUT => $command['api-timeout']
		];
		$curl = curl_init();
		curl_setopt_array($curl, $optionArray);
		$content = curl_exec($curl);
		if(curl_errno($curl))
		{
			$command->error(new Exception(curl_error($curl)));
		}
		curl_close($curl);
		return $content;
	}

	/**
	 * build the url
	 *
	 * @since 2.0.0
	 *
	 * @param Commando\Command $command
	 *
	 * @throws Exception
	 *
	 * @return string
	 */

	public function _buildUrl(Commando\Command $command) : string
	{
		$url = null;
		$providerKey = $command['api-provider'];
		$endpointKey = $command['api-endpoint'];
		$providerArray = $this->_api->getProviderArray();
		$providerValue = $providerArray[$providerKey];
		$endpointValue = $providerValue['endpoint'][$endpointKey];
		$queryValue = $command['api-query'] ? : $providerValue['query'];
		if (!$endpointValue)
		{
			$command->error(new Exception($this->_wording->get('no_endpoint')));
		}
		$url = $providerValue['url'] . $endpointValue;
		if ($queryValue)
		{
			$url .= '&' . $queryValue;
		}
		return $url;
	}

	/**
	 * draw the image
	 *
	 * @since 2.0.0
	 *
	 * @param Commando\Command $command
	 * @param stdClass $result
	 *
	 * @return Pixeler\Image
	 */

	protected function _drawImage(Commando\Command $command, stdClass $result = null) : Pixeler\Image
	{
		$image = Pixeler\Pixeler::image($this->_normalizeThumb($result->thumb), $command['image-resize'], $command['image-invert'], $command['image-weight'], $command['image-dither']);
		if ($command['image-grayscale'])
		{
			$image->clearColors();
		}
		return $image;
	}

	/**
	 * normalize the thumb
	 *
	 * @since 2.2.0
	 *
	 * @param string $thumb
	 *
	 * @return string
	 */

	protected function _normalizeThumb(string $thumb = null) : string
	{
		$urlArray = parse_url($thumb);
		return $urlArray['scheme'] . '://' . $urlArray['host'] . $urlArray['path'];
	}

	/**
	 * get the metadata array
	 *
	 * @since 2.0.0
	 *
	 * @param stdClass $result
	 *
	 * @return array
	 */

	protected function _getMetadataArray(stdClass $result = null) : array
	{
		return array_filter(
		[
			$result->title ? $this->_wording->get('title') . $this->_wording->get('colon') . ' ' . $result->title : null,
			$result->name ? $this->_wording->get('name') . $this->_wording->get('colon') . ' ' . $result->name : null,
			$result->url ? $this->_wording->get('url') . $this->_wording->get('colon') . ' ' . $result->url : null,
			$result->rating ? $this->_wording->get('rating') . $this->_wording->get('colon') . ' ' . $result->rating : null,
			$result->views ? $this->_wording->get('total') . $this->_wording->get('colon') . ' ' . $result->views : null,
			$result->duration ? $this->_wording->get('duration') . $this->_wording->get('colon') . ' ' . $result->duration : null
		]);
	}

	/**
	 * open the browser
	 *
	 * @since 2.0.0
	 *
	 * @param stdClass $result
	 *
	 * @return string
	 */

	protected function _openBrowser(stdClass $result = null) : string
	{
		if (PHP_OS === 'Linux')
		{
			return exec('xdg-open ' . $result->url . ' 2>/dev/null');
		}
		return exec('open ' . $result->url);
	}
}