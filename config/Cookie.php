<?php

class Cookie
{
    private $cookieName;
    private $count;

    public function __construct($cookieName)
    {
        $this->cookieName = $cookieName;
        $this->count = (isset($_COOKIE[$this->cookieName])) ? $_COOKIE[$this->cookieName] : 0;
        setcookie($this->cookieName, $this->count, time() + 86400, '/');
    }

    public function countIncrement()
    {
        $this->count++;
        setcookie($this->cookieName, $this->count, time() + 86400, '/');
        return $this->count;
    }

    public function getName()
    {
        return $this->cookieName;
    }

    public function getCount()
    {
        return $this->count;
    }
}

?>