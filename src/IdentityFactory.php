<?php

namespace Laminas\Mvc\Plugin\Identity;

use Interop\Container\ContainerInterface;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\AuthenticationServiceInterface;
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
        $plugin = new Identity();

        if ($container->has(AuthenticationService::class)) {
            $plugin->setAuthenticationService($container->get(AuthenticationService::class));
        } elseif ($container->has(AuthenticationServiceInterface::class)) {
            $plugin->setAuthenticationService($container->get(AuthenticationServiceInterface::class));
        }

        return $plugin;
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
