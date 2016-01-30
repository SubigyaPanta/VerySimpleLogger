<?php

/**
 * A class that wraps PHP exceptions so that all unattended exceptions during 
 * execution of the program can be recorded/logged.
 */
Class ErrorLog implements Log
{
    public $message;
    public $code;
    public $stacktrace;
    
    protected $exception;
    
    public function __construct( Exception $exception )
    {
        $this->exception = $exception;
        $this->createLog();
    }
    
    public function createLog()
    {
        $this->message  = $this->exception->getMessage();
        $this->code     = $this->exception->getCode();
        $this->stacktrace   = $this->exception->getTraceAsString();
        
        return $this;
    }

}
