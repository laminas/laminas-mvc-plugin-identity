<?php

namespace LaminasTest\Mvc\Plugin\Identity;

use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\Storage\NonPersistent as NonPersistentStorage;
use Laminas\Mvc\Plugin\Identity\Identity as IdentityPlugin;
use PHPUnit\Framework\TestCase;

class IdentityTest extends TestCase
{
    public function testGetIdentity()
    {
        $identity = new TestAsset\IdentityObject();
        $identity->setUsername('a username');
        $identity->setPassword('a password');

        $authenticationService = new AuthenticationService(
            new NonPersistentStorage,
            new TestAsset\AuthenticationAdapter
        );

        $identityPlugin = new IdentityPlugin;
        $identityPlugin->setAuthenticationService($authenticationService);

        $this->assertNull($identityPlugin());

        $this->assertFalse($authenticationService->hasIdentity());

        $authenticationService->getAdapter()->setIdentity($identity);
        $result = $authenticationService->authenticate();
        $this->assertTrue($result->isValid());

        $this->assertEquals($identity, $identityPlugin());
    }
}
