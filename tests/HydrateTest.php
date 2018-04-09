<?php

namespace Keven\Tests;

class HydrateTest extends \PHPUnit\Framework\TestCase
{
    /** @expectedException \BadFunctionCallException */
    function testNotObject()
    {
        \Keven\hydrate(array(), '');
    }

    function testUnchangedObject()
    {
        \Keven\hydrate(array(), $o = new \stdClass);

        $this->assertEquals(new \stdClass, $o);
    }

    function testUndeclaredOnObject()
    {
        \Keven\hydrate(array('foo' => 'bar'), $o = new \stdClass);

        $this->assertEquals('bar', $o->foo);
    }

    function testPublicOnObject()
    {
        \Keven\hydrate(array('bar' => 'baz'), $o = new FooPublic);

        $this->assertEquals('baz', $o->bar());
    }

    function testProtectedOnObject()
    {
        \Keven\hydrate(array('bar' => 'baz'), $o = new FooProtected);

        $this->assertEquals('baz', $o->bar());
    }

    function testPrivateOnObject()
    {
        \Keven\hydrate(array('bar' => 'baz'), $o = new FooPrivate);

        $this->assertEquals('baz', $o->bar());
    }

    function testUnchangedThis()
    {
        $o = new FooPublic;
        $o->hydrate(array());

        $this->assertEquals(new FooPublic, $o);
    }

    function testUndeclaredOnThis()
    {
        $o = new FooPublic;
        $o->hydrate(array('foo' => 'bar'));

        $this->assertEquals('bar', $o->foo);
    }

    function testPublicOnThis()
    {
        $o = new FooPublic;
        $o->hydrate(array('bar' => 'baz'));

        $this->assertEquals('baz', $o->bar());
    }

    function testProtectedOnThis()
    {
        $o = new FooProtected;
        $o->hydrate(array('bar' => 'baz'));

        $this->assertEquals('baz', $o->bar());
    }

    function testPrivateOnThis()
    {
        $o = new FooPrivate;
        $o->hydrate(array('bar' => 'baz'));

        $this->assertEquals('baz', $o->bar());
    }
}

class FooPublic
{
    public $bar;
    function hydrate($p) { \Keven\hydrate($p); }
    function bar() { return $this->bar; }
}

class FooProtected
{
    protected $bar;
    function hydrate($p) { \Keven\hydrate($p); }
    function bar() { return $this->bar; }
}

class FooPrivate
{
    private $bar;
    function hydrate($p) { \Keven\hydrate($p); }
    function bar() { return $this->bar; }
}
