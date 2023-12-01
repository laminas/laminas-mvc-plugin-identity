<?php

declare(strict_types=1);

namespace LaminasTest\Mvc\Plugin\Identity;

// phpcs:disable WebimpressCodingStandard.PHP.CorrectClassNameCase

use Interop\Container\ContainerInterface;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Mvc\Plugin\Identity\Identity;
use Laminas\Mvc\Plugin\Identity\IdentityFactory;
use PHPUnit\Framework\TestCase;

class IdentityFactoryTest extends TestCase
{
    public function testFactoryReturnsEmptyIdentityIfNoAuthenticationServicePresent(): void
    {
        $container = $this->createMock(ContainerInterface::class);

        $container->expects(self::exactly(2))
            ->method('has')
            ->willReturnMap([
                [AuthenticationService::class, false],
                [AuthenticationServiceInterface::class, false],
            ]);

        $container->expects(self::never())->method('get');

        $factory = new IdentityFactory();
        $plugin  = $factory($container, Identity::class);

        $this->assertInstanceOf(Identity::class, $plugin);
        $this->assertNull($plugin->getAuthenticationService());
    }

    public function testFactoryReturnsIdentityWithConfiguredAuthenticationServiceWhenPresent(): void
    {
        $container      = $this->createMock(ContainerInterface::class);
        $authentication = $this->createMock(AuthenticationService::class);

        $container->expects(self::once())
            ->method('has')
            ->with(AuthenticationService::class)
            ->willReturn(true);
        $container->expects(self::once())
            ->method('get')
            ->with(AuthenticationService::class)
            ->willReturn($authentication);

        $factory = new IdentityFactory();
        $plugin  = $factory($container, Identity::class);

        $this->assertInstanceOf(Identity::class, $plugin);
        $this->assertSame($authentication, $plugin->getAuthenticationService());
    }

    public function testFactoryReturnsIdentityWithConfiguredAuthenticationServiceInterfaceWhenPresent(): void
    {
        $container      = $this->createMock(ContainerInterface::class);
        $authentication = $this->createMock(AuthenticationServiceInterface::class);

        $container->expects(self::exactly(2))
            ->method('has')
            ->willReturnMap([
                [AuthenticationService::class, false],
                [AuthenticationServiceInterface::class, true],
            ]);

        $container->expects(self::once())
            ->method('get')
            ->with(AuthenticationServiceInterface::class)
            ->willReturn($authentication);

        $factory = new IdentityFactory();
        $plugin  = $factory($container, Identity::class);

        $this->assertInstanceOf(Identity::class, $plugin);
        $this->assertSame($authentication, $plugin->getAuthenticationService());
    }
}
