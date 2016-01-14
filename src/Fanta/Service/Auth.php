<?php

namespace Fanta\Service;

use Interop\Container\ContainerInterface;

class Auth
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getEncryptedPassword($real)
    {
        return md5($real.$this->container->settings['auth']['secret']);
    }
}