<?php

namespace Keven\Tests;

class ImportPropertiesTest extends \PHPUnit\Framework\TestCase
{
    /** @expectedException \BadFunctionCallException */
    function testNotObject()
    {
        \Keven\import_properties(array(), '');
    }

    function testUnchangedObject()
    {
        \Keven\import_properties(array(), $o = new \stdClass);

        $this->assertEquals(new \stdClass, $o);
    }

    function testUndeclaredOnObject()
    {
        \Keven\import_properties(array('foo' => 'bar'), $o = new \stdClass);

        $this->assertEquals('bar', $o->foo);
    }

    function testPublicOnObject()
    {
        \Keven\import_properties(array('bar' => 'baz'), $o = new FooPublic);

        $this->assertEquals('baz', $o->bar());
    }

    function testProtectedOnObject()
    {
        \Keven\import_properties(array('bar' => 'baz'), $o = new FooProtected);

        $this->assertEquals('baz', $o->bar());
    }

    function testPrivateOnObject()
    {
        \Keven\import_properties(array('bar' => 'baz'), $o = new FooPrivate);

        $this->assertEquals('baz', $o->bar());
    }

    function testUnchangedThis()
    {
        $o = new FooPublic;
        $o->import(array());

        $this->assertEquals(new FooPublic, $o);
    }

    function testUndeclaredOnThis()
    {
        $o = new FooPublic;
        $o->import(array('foo' => 'bar'));

        $this->assertEquals('bar', $o->foo);
    }

    function testPublicOnThis()
    {
        $o = new FooPublic;
        $o->import(array('bar' => 'baz'));

        $this->assertEquals('baz', $o->bar());
    }

    function testProtectedOnThis()
    {
        $o = new FooProtected;
        $o->import(array('bar' => 'baz'));

        $this->assertEquals('baz', $o->bar());
    }

    function testPrivateOnThis()
    {
        $o = new FooPrivate;
        $o->import(array('bar' => 'baz'));

        $this->assertEquals('baz', $o->bar());
    }
}

class FooPublic
{
    public $bar;
    function import($p) { \Keven\import_properties($p); }
    function bar() { return $this->bar; }
}

class FooProtected
{
    protected $bar;
    function import($p) { \Keven\import_properties($p); }
    function bar() { return $this->bar; }
}

class FooPrivate
{
    private $bar;
    function import($p) { \Keven\import_properties($p); }
    function bar() { return $this->bar; }
}
