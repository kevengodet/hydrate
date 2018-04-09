# keven/import-properties

Import an array of parameters into an object properties.

## Install

```shell
$ composer install keven/import-properties
```

## Usage

```php
<?php

// PHP 5.6+

use function Keven\import_properties;
import_properties(['foo' => 'bar'], $myObject);
echo $myObject; // "bar"

class Foo
{
    private $bar;
    public function __construct($args)
    {
        import_properties($args);
    }
    public funnction getBar()
    {
        return $this->bar;
    }
}
$foo = new Foo(['bar' => 'baz']);
echo $foo->getBar(); // "baz"

// PHP 5.3-5.5

\Keven\import_properties(array('foo' => 'bar'), $myObject);
echo $myObject; // "bar"

$foo = new Foo(array('bar' => 'baz'));
echo $foo->getBar(); // "baz"
```
