# keven/hydrate

Hydrate an object from an array of properties.

## Install

```shell
$ composer install keven/hydrate
```

## Usage

```php
<?php

// PHP 5.6+

use function Keven\hydrate;
hydrate(['foo' => 'bar'], $myObject);
echo $myObject; // "bar"

class Foo
{
    private $bar;
    public function __construct($args)
    {
        hydrate($args);
    }
    public funnction getBar()
    {
        return $this->bar;
    }
}
$foo = new Foo(['bar' => 'baz']);
echo $foo->getBar(); // "baz"

// PHP 5.3-5.5

\Keven\hydrate(array('foo' => 'bar'), $myObject);
echo $myObject; // "bar"

$foo = new Foo(array('bar' => 'baz'));
echo $foo->getBar(); // "baz"
```
