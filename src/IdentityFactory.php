<?php
/**
 * @link      http://github.com/zendframework/zend-mvc-plugin-identity for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\Mvc\Plugin\Identity;

use Interop\Container\ContainerInterface;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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
     * For use with zend-servicemanager v2; proxies to __invoke().
     *
     * @param ServiceLocatorInterface $container
     * @return Identity
     */
    public function createService(ServiceLocatorInterface $container)
    {
        return $this($container, Identity::class);
    }
}
