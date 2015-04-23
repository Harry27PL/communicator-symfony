<?php

function isAjax()
{
    return (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
}

function isPOST()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function isGET()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function clearArray($array)
{
    foreach ($array as &$v)
    {
        if (is_array($v))
            $v = clearArray($v);

        else
            $v = null;
    }
    unset($v);

    return $array;
}

class hasValueclass {
    public $value = false;
}

function hasValue($array)
{
    $np = new hasValueClass();

    array_walk_recursive($array, function($v, $k, $h){
        if ($v)
            $h->value = true;
    }, $np);

    return $np->value;
}

function hasValueObjects($array)
{
    foreach ($array as $v) {
        if (hasValue((array) $v))
            return true;
    }

    return false;
}

function hasValueObject($object)
{
    return hasValue((array) $object);
}

function lastKey($array)
{
    end($array);

    return key($array);
}

function randomString($length)
{
    return substr(str_shuffle(md5(time())), 0, $length);
}

function hoursDiff(\DateTime $time, \DateTime $from = null)
{
    if (!$from)
        $from = new \DateTime();

    $diff = $time->diff($from);

    $hours = $diff->days * 24 + $diff->h;

    return $hours;
}

function minutesDiff(\DateTime $time)
{
    $diff = $time->diff(new \DateTime());

    $hours = $diff->days * 24 + $diff->h;
    $minutes = $hours * 60 + $diff->i;

    return $minutes;
}

function secondsDiff(\DateTime $time, $from = null)
{
    if (!$from)
        $from = new \DateTime();

    $diff = $time->diff($from);

    $hours = $diff->days * 24 + $diff->h;
    $minutes = $hours * 60 + $diff->i;
    $seconds = $minutes * 60 + $diff->s;

    return $seconds;
}

function flattenArray(array $array)
{
    $return = array();

    array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });

    return $return;
}

function in_array_objects($needle, array $haystack)
{
    foreach ($haystack as $obj)
        if ($needle == $obj)
            return true;

    return false;
}