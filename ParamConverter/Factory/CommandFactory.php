<?php

declare (strict_types = 1);

namespace SymfonyNotes\CommandBusBundle\ParamConverter\Factory;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use SymfonyNotes\CommandBusBundle\Command\CommandInterface;

/**
 * Class CommandFactory
 */
class CommandFactory
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param Request $request
     * @param string  $commandClassName
     *
     * @throws \InvalidArgumentException
     *
     * @return CommandInterface
     */
    public function createFromRequest(Request $request, string $commandClassName): CommandInterface
    {
        return $this->serializer->deserialize($this->extractDataFromRequest($request), $commandClassName, 'json');
    }

    /**
     * @param Request $request
     *
     * @return string json
     */
    private function extractDataFromRequest(Request $request)
    {
        $data = $request->attributes->all();

        if (!empty($request->getContent())) {
            $content = json_decode($request->getContent(), true);
            if (JSON_ERROR_NONE !== json_last_error()) {
                throw new \InvalidArgumentException(sprintf('Request json decode errors: %s', json_last_error_msg()));
            }

            $data += $content;
        }

        $data += $request->query->all();

        unset($data['_controller'], $data['_route'], $data['_route_params'], $data['_method'], $data['_converters']);

        return json_encode($data);
    }
}
