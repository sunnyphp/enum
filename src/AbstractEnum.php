<?php
declare(strict_types=1);

namespace SunnyPHP\Enum;

use ReflectionClass;

/**
 * Class AbstractEnum
 * @package SunnyPHP\Enum
 * @author Sunny
 */
abstract class AbstractEnum
{
	/**
	 * Returns constant value if exists or default value if not exists
	 * @param string $constant
	 * @param mixed $default Default value if constant is not exists
	 * @return mixed
	 */
	public static function get(string $constant, $default = null)
	{
		$all = static::getAll();
		
		return (array_key_exists($constant, $all) ? $all[$constant] : $default);
	}
	
	/**
	 * Returns all constant values
	 * @return array
	 */
	public static function getValues(): array
	{
		return array_values(static::getAll());
	}
	
	/**
	 * Returns all keys (constant names)
	 * @return array
	 */
	public static function getKeys(): array
	{
		return array_keys(static::getAll());
	}
	
	/**
	 * Returns all constants, key-value pairs
	 * @return array
	 */
	public static function getAll(): array
	{
		static $constants = [];
		
		if ($constants === []) {
			$constants = (new ReflectionClass(static::class))->getConstants();
		}
		
		return $constants;
	}
	
	/**
	 * Returns True if constant value is exists
	 * @param $value
	 * @return bool
	 */
	public static function hasValue($value): bool
	{
		return in_array($value, static::getAll(), true);
	}
	
	/**
	 * Returns True if constant is exists
	 * @param string $constant
	 * @return bool
	 */
	public static function hasKey(string $constant): bool
	{
		return array_key_exists($constant, static::getAll());
	}
	
	/**
	 * Returns True if one or more constants is exists
	 * @param mixed ...$constants
	 * @return bool
	 */
	public static function hasAnyKey(...$constants): bool
	{
		$defined = array_keys(static::getAll());
		
		return array_intersect($defined, $constants) !== [];
	}
}
