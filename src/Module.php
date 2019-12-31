<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-plugin-identity for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-plugin-identity/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-plugin-identity/blob/master/LICENSE.md New BSD License
 */

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
                'aliases' => [
                    'identity' => Identity::class,
                    'Identity' => Identity::class,
                    'Laminas\Mvc\Controller\Plugin\Identity' => Identity::class,

                    // Legacy Zend Framework aliases
                    'Zend\Mvc\Controller\Plugin\Identity' => 'Laminas\Mvc\Controller\Plugin\Identity',
                    \Zend\Mvc\Plugin\Identity\Identity::class => Identity::class,
                ],
                'factories' => [
                    Identity::class => IdentityFactory::class,
                ],
            ],
        ];
    }
}
