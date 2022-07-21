<?php

declare(strict_types=1);

namespace Laminas\Mvc\Plugin\Identity;

// phpcs:disable WebimpressCodingStandard.PHP.CorrectClassNameCase

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
     * @param string|null $name
     * @return Identity
     */
    public function __invoke(ContainerInterface $container, $name, ?array $options = null)
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
     * @deprecated Since 1.4.0 - Service Manager v2 is no longer installable
     *
     * @return Identity
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, Identity::class);
    }
}
