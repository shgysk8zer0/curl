<?php
/**
 * @author Chris Zuber
 * @package shgysk8zer0\cURL
 * @subpackage Interfaces
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
namespace shgysk8zer0\cURL\Interfaces;

/**
 * curl_* functions as class methods
 * Does not include shared or multi functions
 * @see https://secure.php.net/manual/en/book.curl.php
 */
Interface Basic
{
	/**
	 * [init description]
	 * @param  [type] $url [description]
	 * @return [type]      [description]
	 */
	public function init($url = null);

	/**
	 * [reset description]
	 */
	public function reset();

	/**
	 * [close description]
	 * @return [type] [description]
	 */
	public function close();

	/**
	 * [pause description]
	 * @param  [type] $bitmask [description]
	 * @return [type]          [description]
	 */
	public function pause($bitmask);

	/**
	 * [copyHandle description]
	 * @return [type] [description]
	 */
	public function copyHandle();

	/**
	 * [fileCreate description]
	 * @return [type] [description]
	 */
	public function fileCreate();

	/**
	 * [exec description]
	 * @return [type] [description]
	 */
	public function exec();

	/**
	 * [setOpt description]
	 * @param [type] $option [description]
	 * @param [type] $value  [description]
	 */
	public function setOpt($option, $value);

	/**
	 * [setOptArray description]
	 * @param Array $options [description]
	 */
	public function setOptArray(Array $options);

	/**
	 * [escape description]
	 * @param  [type] $str [description]
	 * @return [type]      [description]
	 */
	public function escape($str);

	/**
	 * [unescape description]
	 * @param  [type] $str [description]
	 * @return [type]      [description]
	 */
	public function unescape($str);

	/**
	 * [getInfo description]
	 * @param  [type] $opt [description]
	 * @return [type]      [description]
	 */
	public function getInfo($opt = null);

	/**
	 * [errno description]
	 * @return [type] [description]
	 */
	public function errno();

	/**
	 * [error description]
	 * @return [type] [description]
	 */
	public function error();

	/**
	 * [strerror description]
	 * @param  [type] $errornum [description]
	 * @return [type]           [description]
	 */
	public function strerror($errornum);
}
