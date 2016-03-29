<?php
/**
 * @link      http://github.com/zendframework/zend-mvc-plugin-identity for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ZendTest\Mvc\Plugin\Identity\TestAsset;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;

class AuthenticationAdapter implements AdapterInterface
{
    protected $identity;

    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }

    public function authenticate()
    {
        return new Result(Result::SUCCESS, $this->identity);
    }
}
