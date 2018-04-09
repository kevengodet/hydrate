<?php

namespace Keven;

/**
 * Hydrate an object from an array of properties
 *
 * Usage:
 *
 * import(['foo' => 'bar'], $myObject);
 *
 * @param array $properties
 * @param object $object
 * @throws \BadFunctionCallException
 */
function hydrate(array $properties, $object = null)
{
    if (is_null($object)) {
        $trace = debug_backtrace();
        if (!isset($trace[1]) || !isset($trace[1]['object'])) {
            throw new \BadFunctionCallException(__FUNCTION__.' must be called from/with an object.');
        }

        $object = $trace[1]['object'];
    } else {
        if (!is_object($object)) {
            throw new \BadFunctionCallException(__FUNCTION__.' must be called from/with an object.');
        }
    }

    $r = new \ReflectionObject($object);
    foreach ($properties as $name => $value) {
        if (!$r->hasProperty($name)) {
            $object->$name = $value;
        } else {
            $p = $r->getProperty($name);
            if ($p->isPublic()) {
                $object->$name = $value;
            } else {
                $p->setAccessible(true);
                $p->setValue($object, $value);
            }
        }
    }
}
