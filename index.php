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

$config = new LogConfig(); // load configuration
try{
    $userlog    = new UserLog(); // Create User Log object
    $logger     = LoggerFactory::getLogger($config->loggerType); // get the type of logger set in configuration
    $logger->writeLog( $userlog ); // Write User Log
    
    throw new Exception( 'This message will be logged', '1010' );
} 
catch (Exception $ex) {
    $errorLog   = new ErrorLog($ex); // Create Error log object
    $logger     = LoggerFactory::getLogger($config->loggerType);
    $logger->writeLog( $errorLog ); // Write Error Log
}