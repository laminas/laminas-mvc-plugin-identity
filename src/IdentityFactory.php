<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-plugin-identity for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-plugin-identity/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-plugin-identity/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Mvc\Plugin\Identity;

use Interop\Container\ContainerInterface;
use Laminas\Authentication\AuthenticationService;
use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class IdentityFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return Identity
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $helper = new Identity();
        if ($container->has(AuthenticationService::class)) {
            $helper->setAuthenticationService($container->get(AuthenticationService::class));
        }
        return $helper;
    }

    /**
     * Create and return Identity instance
     *
     * For use with laminas-servicemanager v2; proxies to __invoke().
     *
     * @param ServiceLocatorInterface $container
     * @return Identity
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, Identity::class);
    }
}
