<?php
session_start();
//load log configuration
require_once 'LogConfig.php';

// load base log and types of log
require_once 'Log.php';
require_once 'UserLog.php';
require_once 'ErrorLog.php';

//load base Logger and types of Logger
require_once 'Logger.php';
require_once 'CsvLogger.php';
require_once 'AnyOtherLogger.php';
require_once 'LoggerFactory.php';

try{
    $config     = new LogConfig();
    $userlog    = new UserLog();
    $logger     = LoggerFactory::getLogger($config->loggerType);
    $logger->writeLog( $userlog );
    
    throw new Exception( 'This message will be logged', '1010' );
} 
catch (Exception $ex) {
    $errorLog   = new ErrorLog($ex);
    $logger     = LoggerFactory::getLogger();
    $logger->writeLog( $errorLog );
}