<?php

namespace Http\Header;

class Factory
{
    /**
     * Returns a header provided a field and value.
     *
     * @param string $field
     * @param string $value
     * @return \Http\AbstractHeader
     */
    public static function create($field, $value)
    {
        switch ($field)
        {
            case General::FIELD_CACHE_CONTROL:
                // FALL THROUGH
            case General::FIELD_CONNECTION:
                // FALL THROUGH
            case General::FIELD_DATE:
                // FALL THROUGH
            case General::FIELD_PRAGMA:
                // FALL THROUGH
            case General::FIELD_TRANSFER_ENCODING:
                // FALL THROUGH
            case General::FIELD_UPGRADE:
                // FALL THROUGH
            case General::FIELD_VIA:
                // FALL THROUGH
            case General::FIELD_WARNING:

                return new General($field, $value);

                break;

            case Entity::FIELD_ALLOW:
				// FALL THROUGH
            case Entity::FIELD_CONTENT_ENCODING:
				// FALL THROUGH
            case Entity::FIELD_CONTENT_LANGUAGE:
				// FALL THROUGH
            case Entity::FIELD_CONTENT_LENGTH:
				// FALL THROUGH
            case Entity::FIELD_CONTENT_LOCATION:
				// FALL THROUGH
            case Entity::FIELD_CONTENT_MD5:
				// FALL THROUGH
            case Entity::FIELD_CONTENT_RANGE:
				// FALL THROUGH
            case Entity::FIELD_CONTENT_TYPE:
				// FALL THROUGH
            case Entity::FIELD_EXPIRES:

                return new Entity($field, $value);

                break;

            case Request::FIELD_ACCEPT:
                // FALL THROUGH
            case Request::FIELD_ACCEPT_CHARSET:
                // FALL THROUGH
            case Request::FIELD_ACCEPT_ENCODING:
                // FALL THROUGH
            case Request::FIELD_ACCEPT_LANGUAGE:
                // FALL THROUGH
            case Request::FIELD_AUTHORIZATION:
                // FALL THROUGH
            case Request::FIELD_EXPECT:
                // FALL THROUGH
            case Request::FIELD_FROM:
                // FALL THROUGH
            case Request::FIELD_HOST:
                // FALL THROUGH
            case Request::FIELD_IF_MATCH:
                // FALL THROUGH
            case Request::FIELD_IF_MODIFIED_SINCE:
                // FALL THROUGH
            case Request::FIELD_IF_NONE_MATCH:
                // FALL THROUGH
            case Request::FIELD_IF_RANGE:
                // FALL THROUGH
            case Request::FIELD_IF_UNMODIFIED_SINCE:
                // FALL THROUGH
            case Request::FIELD_PROXY_AUTHORIZATION:
                // FALL THROUGH
            case Request::FIELD_REFERER:
                // FALL THROUGH
            case Request::FIELD_TE:
                // FALL THROUGH
            case Request::FIELD_USER_AGENT:
                // FALL THROUGH
            case Request::FIELD_VARY:

                return Request\Factory::create($field, $value);

                break;

            case Response::FIELD_ACCEPT_RANGES:
				// FALL THROUGH
            case Response::FIELD_AGE:
				// FALL THROUGH
            case Response::FIELD_ETAG:
				// FALL THROUGH
            case Response::FIELD_LOCATION:
				// FALL THROUGH
            case Response::FIELD_PROXY_AUTHENTICATE:
				// FALL THROUGH
            case Response::FIELD_RETRY_AFTER:
				// FALL THROUGH
            case Response::FIELD_SERVER:
				// FALL THROUGH
            case Response::FIELD_WWW_AUTHENTICATE:

                return new Response($field, $value);

                break;

            default:

                return new Custom($field, $value);

                break;
        }
    }
}