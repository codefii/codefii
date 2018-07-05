<?php

namespace Codefii\Http;

/**
 * Input
 */
class Input
{
    /**
     * Verif si donnée envoyé en POST existe
     *
     * @param string $name
     * @return bool
     */
    public static function hasPost(string $name): bool
    {
        return (array_key_exists($name, $_POST));
    }

    /**
     * Si donnée envoye en POST, et si ce $name existe -> return $_POST['name']
     *
     * @param string $name
     * @return array|null
     */
    public static function post(string $name)
    {
        return (isset($_POST[$name]) && $_POST[$name] != '') ? $_POST[$name] : '';
    }

    /**
     * Verif si donnée envoyé en GET existe
     *
     * @param string $name
     * @return bool
     */
    public static function hasGet(string $name): bool
    {
        return (array_key_exists($name, $_GET));
    }

    /**
     * Si donnée envoye en GET, et si ce $name existe -> return $_GET['name']
     *
     * @param string $name
     *  @return array|null - Donnée envoyée en GET
     */
    public static function get(string $name)
    {
        return (isset($_GET[$name]) && $_GET[$name] != '') ? $_GET[$name] : '';
    }
}
