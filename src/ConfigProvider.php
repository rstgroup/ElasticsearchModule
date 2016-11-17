<?php

namespace RstGroup\ElasticsearchModule;

use Elasticsearch\Client;

/**
 * @codeCoverageIgnore
 */
final class ConfigProvider
{

    public function __invoke()
    {
        $config = $this->getElasticsearchConfig();
        $config['dependencies'] = $this->getDependenciesConfig();

        return $config;
    }

    public function getDependenciesConfig()
    {
        return [
            'factories' => [
                Client::class => ElasticsearchClientFactory::class,
            ],
        ];
    }

    public function getElasticsearchConfig(array $data = [])
    {
        return [
            'rst_group' => [
                'elasticsearch' => $data,
            ],
        ];
    }
}