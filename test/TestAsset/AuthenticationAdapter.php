<?php

declare(strict_types=1);

namespace LaminasTest\Mvc\Plugin\Identity\TestAsset;

use Laminas\Authentication\Adapter\AdapterInterface;
use Laminas\Authentication\Result;

class AuthenticationAdapter implements AdapterInterface
{
    /** @var mixed */
    protected $identity;

    /** @param mixed $identity */
    public function setIdentity($identity): void
    {
        $this->identity = $identity;
    }

    public function authenticate(): Result
    {
        return new Result(Result::SUCCESS, $this->identity);
    }
}
