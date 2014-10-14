<?php

namespace Http\Message;

use \Http\Exception;

class Request extends AbstractMessage
{
    /**
     * The request method.
     *
     * @var string
     */
    protected $_method;
    /**
     * The request URI.
     *
     * @var string
     */
    protected $_uri;

    /**
     * Constructs a new Request Message
     *
     * @param string $method The request method.
     * @param string $uri The request URI.
     * @param string $protocolVersion The message protocol version.
     * @param array $headers The message headers.
     * @param string $body The message body.
     */
    public function __construct($method, $uri, $protocolVersion, array $headers = [], $body = NULL)
    {
        $this->_setMethod($method);
        $this->_setUri($uri);
        $this->_setProtocolVersion($protocolVersion);
        $this->_setHeaders($headers);
        $this->_setBody($body);
    }

    /**
     * Sets the request method.
     *
     * @param string $method
     */
    protected function _setMethod($method)
    {
        switch ($method)
        {
            case Request\Method::GET:
                // FALL THROUGH
            case Request\Method::POST:
                // FALL THROUGH
            case Request\Method::PUT:
                // FALL THROUGH
            case Request\Method::DELETE:
                // FALL THROUGH
            case Request\Method::HEAD:
                // FALL THROUGH
            case Request\Method::OPTIONS:
                // FALL THROUGH
            case Request\Method::TRACE:
                // FALL THROUGH
            case Request\Method::CONNECT:

                $this->_method = $method;

                break;

            default:

                throw new Exception('Method not implemented: ' . $method, Exception::CODE_NOT_IMPLEMENTED);

                break;
        }
    }

    /**
     * Sets the request uri.
     *
     * @param string $uri
     */
    protected function _setUri($uri)
    {
        $this->_uri = $uri;
    }

	/**
     * Returns the request method.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->_method;
    }

	/**
     * Returns the request URI.
     *
     * @return string
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * A factory for retrieving a request message.
     *
     * @return Request
     */
    public static function create($method = NULL, $uri = NULL, $protocolVersion = NULL, array $headers = NULL,
        $body = NULL)
    {
        $method          = isset_or($method, $_SERVER['REQUEST_METHOD']);
        $uri             = isset_or($uri, $_SERVER['REQUEST_URI']);
        $protocolVersion = isset_or($protocolVersion, $_SERVER['SERVER_PROTOCOL']);
        $headers         = isset_or($headers, static::_getHeadersFromRequest());
        $body            = isset_or($body, static::_getBodyFromRequest());

        return new static($method, $uri, $protocolVersion, $headers, $body);
    }

    /**
     * Retrieves headers from traditional web requests.
     *
     * @return array
     */
    protected static function _getHeadersFromRequest()
    {
        $headers = [];

        foreach ($_SERVER as $key => $value)
        {
            if ('HTTP_' == substr($key, 0, 5))
            {
                $field  = substr($key, 5);
                $header = \Http\Header\Factory::create($field, $value);

                if (array_key_exists($field, $headers))
                {
                    (array) $headers[$field][] = $header;
                }
                else
                {
                    $headers[$field] = $header;
                }
            }
        }

        return $headers;
    }

    /**
     * Returns the body of the request.
     *
     * @return string
     */
    protected static function _getBodyFromRequest()
    {
        return file_get_contents('php://input');
    }
}