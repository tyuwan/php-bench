<?php
/**
 * Find the fastest way to extract ID from multi-dimension array
 *
 * @file    ExtractIdFromMultiDimArr.php
 *
 * PHP version 5.3.9+
 *
 * @author  Yancharuk Alexander <alex@itvault.info>
 * @date    Сбт Фев 16 17:01:16 2013
 * @copyright The BSD 3-Clause License.
 */

namespace Tests;

use Veles\Tools\CliProgressBar;
use Veles\Tools\Timer;
use Application\TestApplication;

/**
 * Class ExtractIdFromMultiDimArr
 * @author  Yancharuk Alexander <alex@itvault.info>
 */
class ExtractIdFromMultiDimArr extends TestApplication
{
	protected static $repeats = 1000;

	final public static function run()
	{
		$array = array(
			array('ID' => '2'),
			array('ID' => '3')
		);

		$repeats = self::getRepeats();
		$bar = new CliProgressBar($repeats);
		$result = array();
		for ($i = 0; $i <= $repeats; ++$i) {
			Timer::start();
			$result = array_map(function($element) {
				return $element['ID'];
			}, $array);
			Timer::stop();
			$bar->update($i);
		}

		self::addResult('array_map', Timer::get());

		$bar = new CliProgressBar($repeats);

		$result = array();
		Timer::reset();
		for ($i = 0; $i <= $repeats; ++$i) {
			Timer::start();
			foreach ($array as $element) {
				$result[] = $element['ID'];
			}
			Timer::stop();
			$bar->update($i);
		}

		self::addResult('foreach', Timer::get());

		$bar = new CliProgressBar($repeats);

		$result = array();
		Timer::reset();
		for ($i = 0; $i <= $repeats; ++$i) {
			Timer::start();
			foreach ($array as $element) {
				array_push($result, $element['ID']);
			}
			Timer::stop();
			$bar->update($i);
		}

		self::addResult('array_push', Timer::get());
	}
}
