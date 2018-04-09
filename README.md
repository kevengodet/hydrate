# keven/hydrate

[![Latest Stable Version](https://poser.pugx.org/kevengodet/hydrate/version)](https://packagist.org/packages/keven/hydrate)
[![Build Status](https://travis-ci.org/kevengodet/hydrate.svg)](https://travis-ci.org/kevengodet/hydrate)
[![License](https://poser.pugx.org/keven/hydrate/license)](https://packagist.org/packages/keven/hydrate)
[![Total Downloads](https://poser.pugx.org/keven/hydrate/downloads)](https://packagist.org/packages/keven/hydrate)

Hydrate an object from an array of properties.

## Install

```shell
$ composer install keven/hydrate
```

## Usage

Hydrate a given object:

```php
<?php

$obj = new stdClass;
\Keven\hydrate(array('foo' => 'bar'), $obj);
echo $obj->foo; // "bar"
```

Hydrate from `$this` (you don't have to pass the object parameter):

```php
<?php

$car = new Car(array(
    'engine' => 'V8',
    'color'  => 'red',
    'brand'  => 'Chevrolet',
));
echo $car->getColor(); // "red"

class Car
{
    private $engine, $color, $brand;

    public function __construct($args)
    {
        hydrate($args);
    }

    public function getEngine()
    {
        return $this->engine;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getBrand()
    {
        return $this->brand;
    }
}
```