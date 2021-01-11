<?php

namespace Lmh\WeChatPayV3\Kernel\Exceptions;

use Psr\Http\Message\ResponseInterface;

class HttpException extends Exception
{
    /**
     * @var ResponseInterface|null
     */
    public $response;

    /**
     * @var ResponseInterface|array|object|string
     */
    public $formattedResponse;

    /**
     * HttpException constructor.
     *
     * @param string $message
     * @param ResponseInterface|null $response
     * @param null $formattedResponse
     * @param int|null $code
     */
    public function __construct(string $message, ResponseInterface $response = null, $formattedResponse = null, $code = null)
    {
        parent::__construct($message, $code);

        $this->response = $response;
        $this->formattedResponse = $formattedResponse;

        if ($response) {
            $response->getBody()->rewind();
        }
    }
}
