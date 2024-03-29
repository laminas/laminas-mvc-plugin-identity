<?php

declare(strict_types=1);

namespace LaminasTest\Mvc\Plugin\Identity;

use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\NonPersistent as NonPersistentStorage;
use Laminas\Mvc\Plugin\Identity\Identity as IdentityPlugin;
use PHPUnit\Framework\TestCase;

class IdentityTest extends TestCase
{
    public function testGetIdentity(): void
    {
        $identity = new TestAsset\IdentityObject();
        $identity->setUsername('a username');
        $identity->setPassword('a password');

        $testAdapter           = new TestAsset\AuthenticationAdapter();
        $authenticationService = new AuthenticationService(
            new NonPersistentStorage(),
            $testAdapter
        );

        $identityPlugin = new IdentityPlugin();
        $identityPlugin->setAuthenticationService($authenticationService);

        self::assertNull($identityPlugin());

        self::assertFalse($authenticationService->hasIdentity());

        $adapter = $authenticationService->getAdapter();
        self::assertSame($testAdapter, $adapter);
        $adapter->setIdentity($identity);
        $result = $authenticationService->authenticate();
        self::assertTrue($result->isValid());

        self::assertEquals($identity, $identityPlugin());
    }
}
