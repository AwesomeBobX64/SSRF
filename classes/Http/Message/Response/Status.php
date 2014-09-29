<?php

namespace Http\Message\Response;

use \Http\Exception;

class Status
{
    /**
     * The response status code (for interpretation by computers).
     *
     * @var int
     */
    protected $_code;
    /**
     * The response status message (for interpretation by humans).
     *
     * @var string
     */
    protected $_message;

    const CODE_CONTINUE = 100;
    const CODE_SWITCHING_PROTOCOLS = 101;
    const CODE_OK = 200;
    const CODE_CREATED = 201;
    const CODE_ACCEPTED = 202;
    const CODE_NON_AUTHORITATIVE_INFORMATION = 203;
    const CODE_NO_CONTENT = 204;
    const CODE_RESET_CONTENT = 205;
    const CODE_PARTIAL_CONTENT = 206;
    const CODE_MULTIPLE_CHOICES = 300;
    const CODE_MOVED_PERMANENTLY = 301;
    const CODE_FOUND = 302;
    const CODE_SEE_OTHER = 303;
    const CODE_NOT_MODIFIED = 304;
    const CODE_USE_PROXY = 305;
    const CODE_TEMPORARY_REDIRECT = 307;
    const CODE_BAD_REQUEST = 400;
    const CODE_UNAUTHORIZED = 401;
    const CODE_PAYMENT_REQUIRED = 402;
    const CODE_FORBIDDEN = 403;
    const CODE_NOT_FOUND = 404;
    const CODE_METHOD_NOT_ALLOWED = 405;
    const CODE_NOT_ACCEPTABLE = 406;
    const CODE_PROXY_AUTHENTICATION_REQUIRED = 407;
    const CODE_REQUEST_TIMEOUT = 408;
    const CODE_CONFLICT = 409;
    const CODE_GONE = 410;
    const CODE_LENGTH_REQUIRED = 411;
    const CODE_PRECONDITION_FAILED = 412;
    const CODE_PAYLOAD_TOO_LARGE = 413;
    const CODE_URI_TOO_LONG = 414;
    const CODE_UNSUPPORTED_MEDIA_TYPE = 415;
    const CODE_RANGE_NOT_SATISFIABLE = 416;
    const CODE_EXPECTATION_FAILED = 417;
    const CODE_UPGRADE_REQUIRED = 426;

    const MESS_CONTINUE = 'Continue';
    const MESS_SWITCHING_PROTOCOLS = 'Switching Protocols';
    const MESS_OK = 'OK';
    const MESS_CREATED = 'Created';
    const MESS_ACCEPTED = 'Accepted';
    const MESS_NON_AUTHORITATIVE_INFORMATION = 'Non-Authortative Information';
    const MESS_NO_CONTENT = 'No Content';
    const MESS_RESET_CONTENT = 'Reset Content';
    const MESS_PARTIAL_CONTENT = 'Partial Content';
    const MESS_MULTIPLE_CHOICES = 'Multiple Choices';
    const MESS_MOVED_PERMANENTLY = 'Moved Permanently';
    const MESS_FOUND = 'Found';
    const MESS_SEE_OTHER = 'See Other';
    const MESS_NOT_MODIFIED = 'Not Modified';
    const MESS_USE_PROXY = 'Use Proxy';
    const MESS_TEMPORARY_REDIRECT = 'Temporary Redirect';
    const MESS_BAD_REQUEST = 'Bad Request';
    const MESS_UNAUTHORIZED = 'Unauthorized';
    const MESS_PAYMENT_REQUIRED = 'Payment Required';
    const MESS_FORBIDDEN = 'Forbidden';
    const MESS_NOT_FOUND = 'Not Found';
    const MESS_METHOD_NOT_ALLOWED = 'Method Not Allowed';
    const MESS_NOT_ACCEPTABLE = 'Not Acceptable';
    const MESS_PROXY_AUTHENTICATION_REQUIRED = 'Proxy Authentication Required';
    const MESS_REQUEST_TIMEOUT = 'Request Timeout';
    const MESS_CONFLICT = 'Conflict';
    const MESS_GONE = 'Gone';
    const MESS_LENGTH_REQUIRED = 'Length Required';
    const MESS_PRECONDITION_FAILED = 'Precondition Failed';
    const MESS_PAYLOAD_TOO_LARGE = 'Payload too Large';
    const MESS_URI_TOO_LONG = 'URI Too Long';
    const MESS_UNSUPPORTED_MEDIA_TYPE = 'Unsupported Media Type';
    const MESS_RANGE_NOT_SATISFIABLE = 'Range Not Satisfiable';
    const MESS_EXPECTATION_FAILED = 'Expectation Failed';
    const MESS_UPGRADE_REQUIRED = 'Upgrade Required';

    /**
     * An array of status codes mapped to status messages.
     *
     * @var array
     */
    protected static $_codeMessageMap =
    [
        static::CODE_CONTINUE => static::MESS_CONTINUE,
        static::CODE_SWITCHING_PROTOCOLS => static::MESS_SWITCHING_PROTOCOLS,
        static::CODE_OK => static::MESS_OK,
        static::CODE_CREATED => static::MESS_CREATED,
        static::CODE_ACCEPTED => static::MESS_ACCEPTED,
        static::CODE_NON_AUTHORITATIVE_INFORMATION => static::MESS_NON_AUTHORITATIVE_INFORMATION,
        static::CODE_NO_CONTENT => static::MESS_NO_CONTENT,
        static::CODE_RESET_CONTENT => static::MESS_RESET_CONTENT,
        static::CODE_PARTIAL_CONTENT => static::MESS_PARTIAL_CONTENT,
        static::CODE_MULTIPLE_CHOICES => static::MESS_MULTIPLE_CHOICES,
        static::CODE_MOVED_PERMANENTLY => static::MESS_MOVED_PERMANENTLY,
        static::CODE_FOUND => static::MESS_FOUND,
        static::CODE_SEE_OTHER => static::MESS_SEE_OTHER,
        static::CODE_NOT_MODIFIED => static::MESS_NOT_MODIFIED,
        static::CODE_USE_PROXY => static::MESS_USE_PROXY,
        static::CODE_TEMPORARY_REDIRECT => static::MESS_TEMPORARY_REDIRECT,
        static::CODE_BAD_REQUEST => static::MESS_BAD_REQUEST,
        static::CODE_UNAUTHORIZED => static::MESS_UNAUTHORIZED,
        static::CODE_PAYMENT_REQUIRED => static::MESS_PAYMENT_REQUIRED,
        static::CODE_FORBIDDEN => static::MESS_FORBIDDEN,
        static::CODE_NOT_FOUND => static::MESS_NOT_FOUND,
        static::CODE_METHOD_NOT_ALLOWED => static::MESS_METHOD_NOT_ALLOWED,
        static::CODE_NOT_ACCEPTABLE => static::MESS_NOT_ACCEPTABLE,
        static::CODE_PROXY_AUTHENTICATION_REQUIRED => static::MESS_PROXY_AUTHENTICATION_REQUIRED,
        static::CODE_REQUEST_TIMEOUT => static::MESS_REQUEST_TIMEOUT,
        static::CODE_CONFLICT => static::MESS_CONFLICT,
        static::CODE_GONE => static::MESS_GONE,
        static::CODE_LENGTH_REQUIRED => static::MESS_LENGTH_REQUIRED,
        static::CODE_PRECONDITION_FAILED => static::MESS_PRECONDITION_FAILED,
        static::CODE_PAYLOAD_TOO_LARGE => static::MESS_PAYLOAD_TOO_LARGE,
        static::CODE_URI_TOO_LONG => static::MESS_URI_TOO_LONG,
        static::CODE_UNSUPPORTED_MEDIA_TYPE => static::MESS_UNSUPPORTED_MEDIA_TYPE,
        static::CODE_RANGE_NOT_SATISFIABLE => static::MESS_RANGE_NOT_SATISFIABLE,
        static::CODE_EXPECTATION_FAILED => static::MESS_EXPECTATION_FAILED,
        static::CODE_UPGRADE_REQUIRED => static::MESS_UPGRADE_REQUIRED,
    ];

    /**
     * Create a new response status.
     *
     * @param int $code The status code (for interpretation by computers).
     * @param string $message An optional status message (for interpretation by humans).
     */
    public function __construct($code, $message = NULL)
    {
        $this->_setCode($code);

        if (is_null($message))
        {
            $message = static::_getMessageFromCode($code);
        }

        $this->_setMessage($message);
    }

    /**
     * Sets the status code.
     *
     * @param int $code A status code.
     * @throws \Http\Exception Thrown if the status code is not recognized.
     */
    protected function _setCode($code)
    {
        if (!array_key_exists($code, static::$_codeMessageMap))
        {
            throw new Exception('Unknown status code:' . $code, Exception::CODE_INTERNAL_SERVER_ERROR);
        }

        $this->_code = $code;
    }

    /**
     * Returns the status code.
     *
     * @return int
     */
    public function getCode()
    {
        return $this->_code;
    }

    /**
     * Sets the status message.
     *
     * @param string $message
     */
    protected function _setMessage($message)
    {
        $this->_message = $message;
    }

    /**
     * Returns the status message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->_message;
    }

    /**
     * Retrieves a status message for a given status code.
     *
     * @param int $code
     * @throws \Http\Exception Thrown if an unrecognized status code is passed.
     * @return string
     */
    protected static function _getMessageFromCode($code)
    {
        if (!array_key_exists($code, static::$_codeMessageMap))
        {
            throw new Exception('Unknown status code:' . $code, Exception::CODE_INTERNAL_SERVER_ERROR);
        }

        return static::$_codeMessageMap[$code];
    }
}