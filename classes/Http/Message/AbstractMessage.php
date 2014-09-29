<?php

namespace Http\Message;

use \Http\Exception;

abstract class AbstractMessage
{
    /**
     * The message protocol version.
     *
     * @var string
     */
    protected $_protocolVersion;
    /**
     * The message headers.
     *
     * @var array
     */
    protected $_headers;
    /**
     * An optional message body.
     *
     * @var mixed
     */
    protected $_body;

    const PROTOCOL_VERSION_HTTP_1_0 = 'HTTP/1.0';
    const PROTOCOL_VERSION_HTTP_1_1 = 'HTTP/1.1';

    /**
     * Sets the protocol version.
     *
     * @param string $protocolVersion
     */
    protected function _setProtocolVersion($protocolVersion)
    {
        switch ($protocolVersion)
        {
            case self::PROTOCOL_VERSION_HTTP_1_0:
                // FALL THROUGH
            case self::PROTOCOL_VERSION_HTTP_1_1:

                $this->_protocolVersion = $protocolVersion;

                break;

            default:

                throw new Exception('HTTP Version Not Supported: ' . $protocolVersion,
                    Exception::CODE_HTTP_VERSION_NOT_SUPPORTED);

                break;
        }
    }

    /**
     * Sets the message headers.
     *
     * @param array $headers
     */
    protected function _setHeaders($headers)
    {
        $this->_headers = $headers;
    }

    /**
     * Sets the message body.
     *
     * @param mixed $body
     */
    protected function _setBody($body)
    {
        $this->_body = $body;
    }

	/**
     * Returns the protocol version.
     *
     * @return string
     */
    public function getProtocolVersion()
    {
        return $this->_protocolVersion;
    }

	/**
     * Returns the request headers.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

	/**
     * Return the request body.
     *
     * @return mixed
     */
    public function getBody()
    {
        return $this->_body;
    }
}