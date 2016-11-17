<?php

namespace RstGroup\ElasticsearchModule;

use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;
use Interop\Container\ContainerInterface;

/**
 * @codeCoverageIgnore
 */
final class ElasticsearchClientFactory
{
    /**
     * @return Client
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config')['rst_group']['elasticsearch'];

        if (isset($config['logger']) && is_string($config['logger'])) {
            $config['logger'] = $container->get($config['logger']);
        }

        return ClientBuilder::fromConfig($config);
    }
}
