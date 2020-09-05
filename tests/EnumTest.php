<?php
declare(strict_types=1);

namespace SunnyPHP\Tests\Enum;

use SunnyPHP\Enum\AbstractEnum;
use PHPUnit\Framework\TestCase;

/**
 * Class EnumTest
 * @package SunnyPHP\Tests\Enum
 * @author Sunny
 */
class EnumTest extends TestCase
{
	/**
	 * Basics
	 */
	public function testBasics()
	{
		// get value via constant
		$this->assertSame(1, MyEnum::HELLO);
		$this->assertSame(2, MyEnum::WORLD);
		
		// get value via method
		$this->assertSame(1, MyEnum::get('HELLO'));
		$this->assertSame(2, MyEnum::get('WORLD'));
		
		// get default value via method if constant is not exists
		$this->assertNull(MyEnum::get('FOO'));
		$this->assertFalse(MyEnum::get('FOO', false));
		
		// check constant value exists
		$this->assertTrue(MyEnum::hasValue(1));
		$this->assertTrue(MyEnum::hasValue(2));
		
		// check constant exists
		$this->assertTrue(MyEnum::hasKey('HELLO'));
		$this->assertTrue(MyEnum::hasKey('WORLD'));
		
		// check any constant exists
		$this->assertTrue(MyEnum::hasAnyKey('HELLO', 'FOO'));
		$this->assertTrue(MyEnum::hasAnyKey('BAR', 'WORLD', 'FOO'));
		
		// get constants (keys) and constant values
		$this->assertSame(['HELLO', 'WORLD', ], MyEnum::getKeys());
		$this->assertSame([1, 2, ], MyEnum::getValues());
		$this->assertSame(['HELLO' => 1, 'WORLD' => 2, ], MyEnum::getAll());
		
		// case-sensitive keys and values
		$this->assertNull(MyEnum::get('hello'));
		$this->assertNull(MyEnum::get('world'));
		$this->assertFalse(MyEnum::hasKey('hello'));
		$this->assertFalse(MyEnum::hasKey('world'));
		$this->assertFalse(MyEnum::hasAnyKey('hello', 'FOO'));
		$this->assertFalse(MyEnum::hasAnyKey('BAR', 'world', 'FOO'));
		
		// not exists values
		$this->assertFalse(MyEnum::hasValue(-1));
		$this->assertFalse(MyEnum::hasValue(0));
	}
	
	/**
	 * Check strict types
	 */
	public function testStrictTypes()
	{
		// null
		$this->assertSame(null, StrictTypeEnum::NULL);
		$this->assertTrue(StrictTypeEnum::hasKey('NULL'));
		$this->assertTrue(StrictTypeEnum::hasValue(null));
		
		// boolean: true
		$this->assertSame(true, StrictTypeEnum::TRUE);
		$this->assertTrue(StrictTypeEnum::hasKey('TRUE'));
		$this->assertTrue(StrictTypeEnum::hasValue(true));
		
		// boolean: false
		$this->assertSame(false, StrictTypeEnum::FALSE);
		$this->assertTrue(StrictTypeEnum::hasKey('FALSE'));
		$this->assertTrue(StrictTypeEnum::hasValue(false));
		
		// integer
		$this->assertSame(42, StrictTypeEnum::INTEGER);
		$this->assertTrue(StrictTypeEnum::hasKey('INTEGER'));
		$this->assertTrue(StrictTypeEnum::hasValue(42));
		
		// float
		$this->assertSame(.042, StrictTypeEnum::FLOAT);
		$this->assertTrue(StrictTypeEnum::hasKey('FLOAT'));
		$this->assertTrue(StrictTypeEnum::hasValue(.042));
		
		// string
		$this->assertSame('foo', StrictTypeEnum::STRING);
		$this->assertTrue(StrictTypeEnum::hasKey('STRING'));
		$this->assertTrue(StrictTypeEnum::hasValue('foo'));
		
		// array: empty
		$this->assertSame([], StrictTypeEnum::EMPTY_ARRAY);
		$this->assertTrue(StrictTypeEnum::hasKey('EMPTY_ARRAY'));
		$this->assertTrue(StrictTypeEnum::hasValue([]));
		
		// array: filled
		$this->assertSame([42 => [true, ], ], StrictTypeEnum::ARRAY);
		$this->assertTrue(StrictTypeEnum::hasKey('ARRAY'));
		$this->assertTrue(StrictTypeEnum::hasValue([42 => [true, ], ]));
	}
}

/**
 * Test class MyEnum
 * @package SunnyPHP\Tests\Enum
 * @author Sunny
 */
class MyEnum extends AbstractEnum
{
	public const HELLO = 1;
	public const WORLD = 2;
}

/**
 * Test class StrictTypeEnum
 * @package SunnyPHP\Tests\Enum
 * @author Sunny
 */
class StrictTypeEnum extends AbstractEnum
{
	public const NULL = null;
	public const TRUE = true;
	public const FALSE = false;
	public const INTEGER = 42;
	public const FLOAT = .042;
	public const STRING = 'foo';
	public const EMPTY_ARRAY = [];
	public const ARRAY = [42 => [true, ], ];
}
