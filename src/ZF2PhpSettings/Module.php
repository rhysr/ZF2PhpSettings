<?php

namespace ZF2PhpSettings;

use Zend\EventManager\EventInterface as Event;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function onBootstrap(Event $e)
    {
        $config = $e->getParam('application')->getConfiguration();
        if (!isset($config['phpSettings'])) {
            return;
        }

        $phpSettings = $config['phpSettings'];
        foreach ($phpSettings as $setting => $value) {

            if (false === ini_set($setting, $value)) {
                throw new \RuntimeException('Cannot set ini \'' . $setting . '\' to \'' . $value);
            }
        }
    }
}
