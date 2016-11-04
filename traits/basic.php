<?php
/**
 * @author Chris Zuber
 * @package shgysk8zer0\cURL
 * @subpackage Traits
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
namespace shgysk8zer0\cURL\Traits;

/**
 * curl_* functions as class methods
 * Does not include shared or multi functions
 * @see https://secure.php.net/manual/en/book.curl.php
 */
trait Basic
{
	/**
	 * Handle created by `curl_init`
	 * @var Resource
	 */
	private $_ch;

	/**
	 * [init description]
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function init($url = null)
	{
		$this->_ch = curl_init($url);
	}

	/**
	 * [reset description]
	 */
	public function reset()
	{
		return curl_reset($this->_ch);
	}

	/**
	 * [close description]
	 * @return [type] [description]
	 */
	public function close()
	{
		return curl_close($this->_ch);
	}

	/**
	 * [pause description]
	 * @param  [type] $bitmask [description]
	 * @return [type]          [description]
	 */
	public function pause($bitmask)
	{
		return curl_pause($this->_ch, $bitmask);
	}

	/**
	 * [copyHandle description]
	 * @return [type] [description]
	 */
	public function copyHandle()
	{
		return curl_copy_handle($this->_ch);
	}

	/**
	 * [fileCreate description]
	 * @return [type] [description]
	 */
	public function fileCreate()
	{
		return call_user_func_array(func_get_args());
	}

	/**
	 * [exec description]
	 * @return [type] [description]
	 */
	public function exec()
	{
		return curl_exec($this->_ch);
	}

	/**
	 * [setOpt description]
	 * @param [type] $option [description]
	 * @param [type] $value  [description]
	 */
	public function setOpt($option, $value)
	{
		return curl_setopt($this->_ch, $option, $value);
	}

	/**
	 * [setOptArray description]
	 * @param Array $options [description]
	 */
	public function setOptArray(Array $options)
	{
		return curl_setopt_array($this->_ch, $options);
	}

	/**
	 * [escape description]
	 * @param  [type] $str [description]
	 * @return [type]      [description]
	 */
	public function escape($str)
	{
		return curl_escape($this->_ch, $str);
	}

	/**
	 * [unescape description]
	 * @param  [type] $str [description]
	 * @return [type]      [description]
	 */
	public function unescape($str)
	{
		return curl_unescape($this->_ch, $str);
	}

	/**
	 * [getInfo description]
	 * @param  [type] $opt [description]
	 * @return [type]      [description]
	 */
	public function getInfo($opt = null)
	{
		return curl_getinfo($this->_ch, $opt);
	}

	/**
	 * [errno description]
	 * @return [type] [description]
	 */
	public function errno()
	{
		return curl_errno($this->_ch);
	}

	/**
	 * [error description]
	 * @return [type] [description]
	 */
	public function error()
	{
		return curl_error($this->_ch);
	}

	/**
	 * [strerror description]
	 * @param  [type] $errornum [description]
	 * @return [type]           [description]
	 */
	public function strerror($errornum)
	{
		return curl_strerror($this->_ch, $errornum);
	}
}
