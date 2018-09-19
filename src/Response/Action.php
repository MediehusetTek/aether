<?php

namespace Aether\Response;

/**
 * Action response
 *
 * Created: 2007-02-07
 * @author Raymond Julin
 * @package aether.lib
 */
class Action extends Response
{
    /**
     * Constructor
     *
     * @access public
     * @param string $statusCode HTTP Status code for this response
     * @param string $data Optional text for 404 or url for redirect
     */
    public function __construct($statusCode, $data = "")
    {
        $this->statusCode = $statusCode;
        $this->data = $data;
    }

    /**
     * Perform action response.
     * This will set a http header (301,302,401,404)
     * as well as perform a location or status response
     * accordingly
     *
     * @access public
     * @return void
     * @param AetherServiceLocator $sl
     */
    public function draw($sl)
    {
        // @todo: switch to http_response_code()

        switch ($this->statusCode) {
            case 301: // Moved permanently
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: {$this->data}");
                break;
            case 302: // Moved temporarily
                header("HTTP/1.1 302 Found");
                header("Location: {$this->data}");
                break;
            case 400: // Bad Request
                header("HTTP/1.1 400 Bad Request");
                header("Status: 400 Bad Request");

                print $this->data;
                break;
            case 401: // Unauthorized
                header("HTTP/1.1 401 Unauthorized");
                header("Location: {$this->data}");
                break;
            case 403: // Access denied
                header("HTTP/1.1 403 Access denied");
                header("Status: 403 Access denied");

                print $this->data;
                break;
            case 404: // Not found
                header("HTTP/1.1 404 Not found");
                header("Status: 404 Not found");

                print $this->data;
                break;
            case 410: // Gone
                header("HTTP/1.1 410 Gone");
                header("Status: 410 Gone");

                print $this->data;
                break;
        }
    }

    /**
     * Return passed string data (url or 404)
     *
     * @access public
     * @return string
     */
    public function get()
    {
        return $this->data;
    }
}
