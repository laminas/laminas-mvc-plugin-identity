<?php
/**
 * @link      http://github.com/zendframework/zend-mvc-plugin-identity for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Mvc\Plugin\Identity;

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
                    'Zend\Mvc\Controller\Plugin\Identity' => Identity::class,
                ],
                'factories' => [
                    Identity::class => IdentityFactory::class,
                ],
            ],
        ];
    }
}
