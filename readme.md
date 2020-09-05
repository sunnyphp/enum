## Simple AbstractEnum class

### Installation

```shell script
composer require sunnyphp/enum
```

### Usage

```php
use SunnyPHP\Enum\AbstractEnum;

class MyEnum extends AbstractEnum
{
    public const HELLO = 1;
    public const WORLD = 2;
}
```

### Methods

Method name | Description | Example | Returns
----------- | ----------- | ------- | -------
`get` | Returns constant value if exists or default value (42) if not exists | `MyEnum::get('HELLO', 42)` | `1`
`getValues` | Returns all constant values | `MyEnum::getValues()` | `[1, 2, ]`
`getKeys` | Returns all keys (constant names) | `MyEnum::getKeys()` | `['HELLO', 'WORLD', ]`
`getAll` | Returns all constants, key-value pairs | `MyEnum::getAll()` | `['HELLO' => 1, 'WORLD' => 2, ]`
`hasValue` | Returns True if constant value is exists | `MyEnum::hasValue(1)` | `true`
`hasKey` | Returns True if constant is exists | `MyEnum::hasKey('HELLO')` | `true`
`hasAnyKey` | Returns True if one or more constants is exists | `MyEnum::hasAnyKey('FOO', 'HELLO', 'BAR')` | `true`
