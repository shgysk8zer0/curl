<?php
/**
 * @author Chris Zuber
 * @package shgysk8zer0\cURL
 * @version 1.0.0
 * @copyright 2016, Chris Zuber
 * @license http://opensource.org/licenses/GPL-3.0 GNU General Public License, version 3 (GPL-3.0)
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace shgysk8zer0\cURL;

use \shgysk8zer0\Core_API as API;

class Request extends \ArrayObject implements API\Interfaces\toString, Interfaces\Basic
{
	use Traits\Basic;
	/**
	 * Default options
	 * @var array
	 * @see https://secure.php.net/manual/en/function.curl-setopt.php
	 */
	const DEFAULT_OPTS = array(
		CURLOPT_POST           => true,
		CURLOPT_RETURNTRANSFER => true,
	);

	const DEFAULT_HEADERS = array();

	/**
	 * [$_url description]
	 * @var string
	 */
	private $_url;

	public function __construct(
		$url,
		Array $data    = array(),
		Array $headers = array(),
		Array $opts    = array()
	)
	{
		$this->_url = "$url";
		if (! filter_var($this->_url, \FILTER_VALIDATE_URL)) {
			throw new \InvalidArgumentException("{$this->url} is not a valid URL.");
		}

		parent::__construct($data, self::ARRAY_AS_PROPS);
		$headers = array_merge($headers, self::DEFAULT_HEADERS);
		$opts = array_merge($opts, self::DEFAULT_OPTS);
		$this->init();
		// $this->setOptArray($opts);
		$this->setOpt(CURLOPT_POST, true);
		$this->setOpt(CURLOPT_RETURNTRANSFER, true);
		$this->setOpt(CURLOPT_URL, $this->_url);
		$this->setOpt(CURLOPT_HTTPHEADER, $this->_getHeaders($headers));
	}

	public function __destruct()
	{
		$this->close();
	}

	public function __call($prop, Array $args = array())
	{
		$this->$prop = count($args) === 1 ? $args[0] : $args;
	}

	public function __invoke(Array $data = array())
	{
		//return array_merge($this->getArrayCopy(), $data);
		$this->setOpt(
			\CURLOPT_POSTFIELDS,
			http_build_query(array_merge($this->getArrayCopy(), $data))
		);
		$resp = $this->exec();
		if ($this->errno() !== 0) {
			trigger_error($this->error());
		} elseif ($resp === false) {
			throw new \Exception('curl_exec returned boolean false.');
		}
		return $resp;
	}

	public function __toString()
	{
		return http_build_query($this);
	}

	public function __debugInfo()
	{
		return array(
			'Request' => $this->getArrayCopy(),
			'cURL info' => $this->getInfo(),
		);
	}

	private function _getHeaders(Array $headers)
	{
		return array_map(
			[$this, '_mapHeader'],
			array_keys($headers),
			array_values($headers)
		);
	}

	private function _mapHeader($key, $value)
	{
		return "{$key}: {$value}";
	}
}
