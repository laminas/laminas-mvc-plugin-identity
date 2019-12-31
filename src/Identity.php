<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-plugin-identity for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-plugin-identity/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-plugin-identity/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Mvc\Plugin\Identity;

use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Controller plugin to fetch the authenticated identity.
 */
class Identity extends AbstractPlugin
{
    /**
     * @var AuthenticationServiceInterface
     */
    protected $authenticationService;

    /**
     * @return AuthenticationServiceInterface
     */
    public function getAuthenticationService()
    {
        return $this->authenticationService;
    }

    /**
     * @param AuthenticationServiceInterface $authenticationService
     */
    public function setAuthenticationService(AuthenticationServiceInterface $authenticationService)
    {
        $this->authenticationService = $authenticationService;
    }

    /**
     * Retrieve the current identity, if any.
     *
     * If none is present, returns null.
     *
     * @return mixed|null
     * @throws Exception\RuntimeException
     */
    public function __invoke()
    {
        if (! $this->authenticationService instanceof AuthenticationServiceInterface) {
            throw new Exception\RuntimeException(
                'No AuthenticationServiceInterface instance provided; cannot lookup identity'
            );
        }

        if (! $this->authenticationService->hasIdentity()) {
            return;
        }

        return $this->authenticationService->getIdentity();
    }
}
