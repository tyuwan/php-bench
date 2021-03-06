<?php
/**
 * Check what is faster strstr or strpos
 *
 * @file    StrposVsStrstr.php
 *
 * PHP version 5.3.9+
 *
 * @author  Yancharuk Alexander <alex@itvault.info>
 * @date    Wed Oct  2 16:42:55 2013
 * @copyright The BSD 3-Clause License
 */

namespace Tests;

use Veles\Tools\CliProgressBar;
use Veles\Tools\Timer;
use Application\TestApplication;

/**
 * Class StrposVsStrstr
 * @author  Yancharuk Alexander <alex@itvault.info>
 */
class StrposVsStrstr extends TestApplication
{
	protected static $repeats = 10000;

	final public static function run()
	{
		$repeats = self::getRepeats();

		$string = 'This is test string';
		$needle = 'is test';

		$bar = new CliProgressBar($repeats);
		for ($i = 0; $i <= $repeats; ++$i) {
			Timer::start();
			$result = strpos($string, $needle);
			Timer::stop();
			$bar->update($i);
		}

		self::addResult('strpos', Timer::get());

		$bar = new CliProgressBar($repeats);

		Timer::reset();
		for ($i = 0; $i <= $repeats; ++$i) {
			Timer::start();
			$result = strstr($string, $needle);
			Timer::stop();
			$bar->update($i);
		}

		self::addResult('strstr', Timer::get());
	}
}
