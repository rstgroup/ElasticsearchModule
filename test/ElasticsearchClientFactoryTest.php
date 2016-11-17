<?php

namespace RstGroup\ElasticsearchModule\Test;

use Elasticsearch\Client;
use PHPUnit_Framework_TestCase;
use RstGroup\ElasticsearchModule\ConfigProvider;
use RstGroup\ElasticsearchModule\ElasticsearchClientFactory;
use Zend\ServiceManager\ServiceManager;

class ElasticsearchClientFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateValidClientByDefaultConfig()
    {
        $configProvider = new ConfigProvider();

        $serviceManagerConfig = $configProvider->getDependenciesConfig();
        $serviceManagerConfig['services'] = [
            'config' => $configProvider->getElasticsearchConfig(),
        ];

        $container = new ServiceManager($serviceManagerConfig);

        $factory = new ElasticsearchClientFactory();

        $client = $factory->__invoke($container);

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testCreateValidClientWithLogger()
    {
        $configProvider = new ConfigProvider();
        $logger = new \Psr\Log\NullLogger();

        $serviceManagerConfig = $configProvider->getDependenciesConfig();
        $serviceManagerConfig['services'] = [
            'config' => $configProvider->getElasticsearchConfig([
                'logger' => 'logger_service',
            ]),
            'logger_service' => $logger,
        ];

        $container = new ServiceManager($serviceManagerConfig);

        $factory = new ElasticsearchClientFactory();

        $client = $factory->__invoke($container);

        $this->assertInstanceOf(Client::class, $client);
    }
}