<?php

declare(strict_types=1);

namespace Laminas\Mvc\Plugin\Identity;

class Module
{
    /**
     * Provide application configuration.
     *
     * Adds aliases and factories for the Identity plugin.
     *
     * @return array
     */
    public function getConfig()
    {
        return [
            'controller_plugins' => [
                'aliases'   => [
                    'identity'                               => Identity::class,
                    'Identity'                               => Identity::class,
                    'Laminas\Mvc\Controller\Plugin\Identity' => Identity::class,

                    // Legacy Zend Framework aliases
                    'Zend\Mvc\Controller\Plugin\Identity' => Identity::class,
                    'Zend\Mvc\Plugin\Identity\Identity'   => Identity::class,
                ],
                'factories' => [
                    Identity::class => IdentityFactory::class,
                ],
            ],
        ];
    }
}
