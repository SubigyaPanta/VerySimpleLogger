<?php

class UserLog implements Log
{
    public $session_id;
    public $timestamp;
    public $page;
    public $ip;
    public $useragent;

    public function __construct()
    {
        $this->createLog();
    }
    public function createLog()
    {
        $this->session_id      = $this->getSessionId();
        $this->timestamp       = $this->getTimeStamp();
        $this->page            = $this->getCurrentPage();
        $this->ip              = $this->getIp();
        $this->useragent       = $this->getUseragent();
        
        return $this;
    }

    /**
     * 
     * @return string
     */
    protected function getSessionId()
    {
        if ( isset($_SESSION[ 'hash_sess_id' ]) ) {
            return $_SESSION[ 'hash_sess_id' ];
        }
        else {
            $_SESSION['hash_sess_id']  = md5( rand(1000, 9999).gmdate('Ymd').rand(1000, 9999).date('His') );
            return $_SESSION['hash_sess_id'];
        }
    }
    
    protected function getTimeStamp()
    {
        return gmdate( 'YmdHis' );
    }

    protected function getCurrentPage()
    {
        return $_SERVER['REQUEST_URI'];
    }

    protected function getIp()
    {
        return $_SERVER['REMOTE_ADDR'];
    }
    
    protected function getUseragent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
}
