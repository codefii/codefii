<?php

namespace Codefii\Http;
use Codefii\Http\Input;

/**
 * Response
 */
class Response
{
    /**
     * Codes des réponses HTTP
     */
    const STATUS_CODE = [
        // Information 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',

        // Successful 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',
        210 => 'Content Different',
        226 => 'IM Used',

        // Redirection 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        306 => '(Unused)',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',
        310 => 'Too many Redirects',

        // Client error 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',

        418 => 'I\'m a teapot',
        421 => 'Bad mapping / Misdirected Request',
        422 => 'Unprocessable entity',
        423 => 'Locked',
        424 => 'Method failure',
        425 => 'Unordered Collection',
        426 => 'Upgrade Required',
        428 => 'Precondition Required',
        429 => 'Too Many Requests',
        431 => 'Request Header Fields Too Large',
        449 => 'Retry With',
        450 => 'Blocked by Windows Parental Controls',
        451 => 'Unavailable For Legal Reasons',
        456 => 'Unrecoverable Error',
        499 => 'Client has closed connection',

        // Server error 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient storage',
        508 => 'Loop detected',
        509 => 'Bandwidth Limit Exceeded',
        510 => 'Not extended',
        511 => 'Network authentication required',
        520 => 'Web server is returning an unknown error',
    ];


    /**
     * Spécifier l'en-tête HTTP de l'affichage d'une vue
     *
     * @param string $content
     * @param string|null $type
     */
    public static function header(string $content, string $type = null)
    {
        if ($type) {
            header($content.': '.$type.'; charset=UTF-8');
        } else {
            header($content);
        }
    }

    /**
     * Rediriger
     * @param string $url - url vers où regiriger visiteur
     * @param null|int $httpResponseCodeParam - Code de la réponse HTTP
     */
    public static function redirect(string $url, $httpResponseCodeParam = null)
    {
        if ($httpResponseCodeParam) {
            if (array_key_exists($httpResponseCodeParam, self::STATUS_CODE)) {
                $httpResponseCode = $httpResponseCodeParam;

                header('Location: '.$url, true, $httpResponseCode);
            } else {
                getException('Status code "'.$httpResponseCodeParam.'" not good.');

                header('Location: '.$url);
            }
        } else {
            header('Location: '.$url);
        }

        exit();
    }
}
