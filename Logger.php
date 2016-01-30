<?php

abstract class Logger
{
    /**
     *
     * @var Log
     */
    protected $log;
    
    /**
     * 
     * @return Log
     */
    public function getLog()
    {
        return $this->log;
    }
    
    /**
     * 
     * @param Log $log
     * @return \Logger
     */
    public function setLog( Log $log )
    {
        $this->log  = $log;
        return $this;
    }
    
    abstract public function writeLog( Log $log );
}