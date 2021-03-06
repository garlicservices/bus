<?php

namespace Garlic\Bus\Service\Request;

use Garlic\Bus\Entity\Request;
use JMS\Serializer\Serializer;

class RequestService
{
    /** @var Serializer $serializer */
    private $serializer;

    /**
     * RequestService constructor.
     * @param $serializer
     */
    public function __construct($serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * Create request JSON
     *
     * @param $uri
     * @param $method
     * @param array $path
     * @param array $parameters
     * @param array $headers
     * @return Request
     */
    public function create($uri, $path = [], $parameters = [], $headers = [], $method = 'GET')
    {
        return $this->serializer->serialize(
            new Request($uri, $method, $path, $parameters, $headers),
            'json'
        );
    }

    /**
     * Dehydrate content to Request
     *
     * @param $content
     * @return object
     */
    public function hydrate($content)
    {
        return $this->serializer->deserialize(
            $content,
            'Garlic\Bus\Entity\Request',
            'json'
        );
    }
}