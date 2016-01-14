<?php

namespace Fanta\Service;

use Interop\Container\ContainerInterface;

class Session
{
    private $sessionid;

    public function __construct()
    {
        $this->sessionid = session_id();
    }

    public function createSession($user)
    {
        if (!isset($_SESSION['fanta'])) {
            $_SESSION['fanta'] = [];
        }
        $_SESSION['fanta'][$this->sessionid] = [
            'userid' => $user->getId(),
            'user' => $user->getName(),
        ];
    }

    public function destroySession() {
        unset($_SESSION['fanta'][$this->sessionid]);
    }

    public function get()
    {
        if (isset($_SESSION['fanta'][$this->sessionid])) {
            return $_SESSION['fanta'][$this->sessionid];
        } else {
            return null;
        }
    }

    public function getVar($name, $default = null)
    {
        $session = $_SESSION['fanta'][$this->sessionid];
        if (isset($session[$name])) {
            return $session[$name];
        } else {
            return $default;
        }
    }

    public function setVar($name, $val) {
        $_SESSION['fanta'][$this->sessionid][$name] = $val;
    }
}