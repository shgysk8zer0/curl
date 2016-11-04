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

class Response extends \ArrayObject
{
	private $_body    = '';

	public function __construct($ch)
	{
		if (! is_resource($ch)) {
			throw new \InvalidArgumentException('Attempted to get a cURL response without a handle.');
		}
		if (!function_exists('http_parse_headers')) {
			require_once __DIR__ . DIRECTORY_SEPARATOR . 'http_parse_headers.php';
		}
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$resp = curl_exec($ch);
		if (curl_errno($ch) !== 0) {
			trigger_error(curl_error($ch));
		} else {
			$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			parent::__construct(\http_parse_headers(substr($resp, 0, $header_size)), self::ARRAY_AS_PROPS);
			$this->_body = substr($resp, $header_size);
		}
	}

	public function __toString()
	{
		return "{$this->_body}";
	}
}
