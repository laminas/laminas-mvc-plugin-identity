<?php
/**
 * @link      http://github.com/zendframework/zend-mvc-plugin-identity for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Mvc\Plugin\Identity;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\NonPersistent as NonPersistentStorage;
use Zend\Mvc\Plugin\Identity\Identity as IdentityPlugin;

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
