<?php

declare(strict_types=1);

namespace Laminas\Mvc\Plugin\Identity;

use Laminas\Authentication\AuthenticationServiceInterface;
use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Controller plugin to fetch the authenticated identity.
 *
 * @final This class is not intended to be open for extension.
 */
class Identity extends AbstractPlugin
{
    /** @var AuthenticationServiceInterface|null */
    protected $authenticationService;

    /**
     * @return AuthenticationServiceInterface|null
     */
    public function getAuthenticationService()
    {
        return $this->authenticationService;
    }

    /** @return void */
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
            return null;
        }

        return $this->authenticationService->getIdentity();
    }
}
