<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-plugin-identity for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-plugin-identity/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-plugin-identity/blob/master/LICENSE.md New BSD License
 */

namespace LaminasTest\Mvc\Plugin\Identity;

use Interop\Container\ContainerInterface;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\Mvc\Plugin\Identity\IdentityFactory;
use PHPUnit\Framework\TestCase;
use Prophecy\PhpUnit\ProphecyTrait;

class IdentityFactoryTest extends TestCase
{
    use ProphecyTrait;

    public function testFactoryReturnsEmptyIdentityIfNoAuthenticationServicePresent()
    {
        $container = $this->prophesize(ContainerInterface::class);
        $container->has(AuthenticationService::class)->willReturn(false);

        $container->has(\Zend\Authentication\AuthenticationService::class)->willReturn(false);
        $container->get(AuthenticationService::class)->shouldNotBeCalled();
        $container->get(\Zend\Authentication\AuthenticationService::class)->shouldNotBeCalled();
        $container->has(AuthenticationServiceInterface::class)->willReturn(false);
        $container->has(\Zend\Authentication\AuthenticationServiceInterface::class)->willReturn(false);
        $container->get(AuthenticationServiceInterface::class)->shouldNotBeCalled();
        $container->get(\Zend\Authentication\AuthenticationServiceInterface::class)->shouldNotBeCalled();

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
        $container->has(\Zend\Authentication\AuthenticationServiceInterface::class)->willReturn(false);
        $container->get(AuthenticationServiceInterface::class)->shouldNotBeCalled();
        $container->get(\Zend\Authentication\AuthenticationServiceInterface::class)->shouldNotBeCalled();

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

        $container->has(\Zend\Authentication\AuthenticationService::class)->willReturn(false);
        $container->get(AuthenticationService::class)->shouldNotBeCalled();
        $container->get(\Zend\Authentication\AuthenticationService::class)->shouldNotBeCalled();
        $container->has(AuthenticationServiceInterface::class)->willReturn(true);
        $container->get(AuthenticationServiceInterface::class)->will([$authentication, 'reveal']);

        $factory = new IdentityFactory();
        $plugin = $factory($container->reveal(), Identity::class);

        $this->assertInstanceOf(Identity::class, $plugin);
        $this->assertSame($authentication->reveal(), $plugin->getAuthenticationService());
    }
}
