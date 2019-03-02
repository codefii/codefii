<?php
namespace Codefii\Http\HttpInterfaces;
interface RedirectInterface {
    public static function to(string $url);
    public static function back();
    public static function addHeader(string $header);
}