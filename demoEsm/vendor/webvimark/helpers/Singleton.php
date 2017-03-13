<?php
namespace webvimark\helpers;

/**
 * Class Singleton
 *
 * <example>
 * 	Singleton::setData('someKey', $someObject);
 *
 * 	$someObject = Singleton::getData('someKey');
 * </example>
 *
 * @package webvimark\helpers
 */
class Singleton
{
	private static $_instance;

	public $dataArray = array();

	private function __construct() {}

	private function __clone() {}

	/**
	 * getInstance
	 *
	 * @return self
	 */
	public static function getInstance()
	{
		if (null === self::$_instance)
			self::$_instance = new self();

		return self::$_instance;
	}

	/**
	 * setData
	 *
	 * @param string $to
	 * @param mixed $data
	 */
	public static function setData($to, $data)
	{
		$instance = self::getInstance();

		$instance->dataArray[$to] = $data;
	}

	/**
	 * getData
	 *
	 * @param string $from
	 * @param bool   $emptyReturn
	 *
	 * @return mixed
	 */
	public static function getData($from, $emptyReturn = false)
	{
		$instance = self::getInstance();

		return array_key_exists($from, $instance->dataArray) ? $instance->dataArray[$from] : $emptyReturn;
	}

	/**
	 * setData
	 *
	 * @param string|array $keys
	 */
	public static function clearData($keys)
	{
		$keys = (array) $keys;

		$instance = self::getInstance();

		foreach ($keys as $key)
		{
			unset($instance->dataArray[$key]);
		}
	}
}