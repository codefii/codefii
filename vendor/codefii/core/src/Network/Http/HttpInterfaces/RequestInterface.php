<?php

namespace Codefii\Http\HttpInterfaces;
interface RequestInterface{
 public static function exists($post);
 public static function get($item);
}