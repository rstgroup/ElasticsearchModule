<?php

namespace RstGroup\ElasticsearchModule;

/**
 * @codeCoverageIgnore
 */
final class Module
{
    public function getConfig()
    {
        $configProvider = new ConfigProvider();
        $config = $configProvider->getElasticsearchConfig();
        $config['service_manager'] = $configProvider->getDependenciesConfig();

        return $config;
    }
}