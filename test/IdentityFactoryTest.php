<?php
/**
 * @see       https://github.com/zendframework/zend-mvc-plugin-identity for the canonical source repository
 * @copyright Copyright (c) 2018 Zend Technologies USA Inc. (https://www.zend.com)
 * @license   https://github.com/zendframework/zend-mvc-plugin-identity/blob/master/LICENSE.md New BSD License
 */

namespace ZendTest\Mvc\Plugin\Identity;

use Interop\Container\ContainerInterface;
use PHPUnit\Framework\TestCase;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Mvc\Plugin\Identity\Identity;
use Zend\Mvc\Plugin\Identity\IdentityFactory;

class IdentityFactoryTest extends TestCase
{
    public function testFactoryReturnsEmptyIdentityIfNoAuthenticationServicePresent()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $container->has(AuthenticationService::class)->willReturn(false);
        $container->get(AuthenticationService::class)->shouldNotBeCalled();
        $container->has(AuthenticationServiceInterface::class)->willReturn(false);
        $container->get(AuthenticationServiceInterface::class)->shouldNotBeCalled();

        $factory = new IdentityFactory();
        $plugin = $factory($container->reveal(), Identity::class);

        $this->assertInstanceOf(Identity::class, $plugin);
        $this->assertNull($plugin->getAuthenticationService());
    }

    public function testFactoryReturnsIdentityWithConfiguredAuthenticationServiceWhenPresent()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $authentication = $this->prophesize(AuthenticationService::class);

        $container->has(AuthenticationService::class)->willReturn(true);
        $container->get(AuthenticationService::class)->will([$authentication, 'reveal']);
        $container->has(AuthenticationServiceInterface::class)->willReturn(false);
        $container->get(AuthenticationServiceInterface::class)->shouldNotBeCalled();

        $factory = new IdentityFactory();
        $plugin = $factory($container->reveal(), Identity::class);

        $this->assertInstanceOf(Identity::class, $plugin);
        $this->assertSame($authentication->reveal(), $plugin->getAuthenticationService());
    }

    public function testFactoryReturnsIdentityWithConfiguredAuthenticationServiceInterfaceWhenPresent()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $authentication = $this->prophesize(AuthenticationServiceInterface::class);

        $container->has(AuthenticationService::class)->willReturn(false);
        $container->get(AuthenticationService::class)->shouldNotBeCalled();
        $container->has(AuthenticationServiceInterface::class)->willReturn(true);
        $container->get(AuthenticationServiceInterface::class)->will([$authentication, 'reveal']);

        $factory = new IdentityFactory();
        $plugin = $factory($container->reveal(), Identity::class);

        $this->assertInstanceOf(Identity::class, $plugin);
        $this->assertSame($authentication->reveal(), $plugin->getAuthenticationService());
    }
}
