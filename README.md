# VerySimpleLogger
A small module that logs basic user information and errors in a csv file. Additional loggers can be added just by adding other logger classes.

## Basic terms used.
- log: Information to save.
- logger: Way to save the information Eg. CsvLogger saves in csv format. MysqlLogger Saves in database etc.

## How to use ?
First include/require all the required files and start session. To include all files do this:
```php
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
```

### Writing User logs
```php
// in any page insert this code to log basic user information
$config   = new LogConfig();
$userlog  = new UserLog(); // Create User Log object
$logger   = LoggerFactory::getLogger($config->loggerType); // get the type of logger specified in configuration
$logger->writeLog( $userlog ); // Write User Log

```

### Writing Error logs
```php
// in any catch statement insert this code to log unaddressed exceptions encountered
$config   = new LogConfig();
$errorLog = new ErrorLog($ex); // Create Error log object
$logger   = LoggerFactory::getLogger($config->loggerType);
$logger->writeLog( $errorLog ); // Write Error Log
```

## Output
Currently csv logs are located inside "log" directory. The filename is generated as per the type of log and the date in which it was generated.

## How to extend ?
1. To add new logging method, just add a new logger class that implements "Logger". Write its logging algorithm in "writeLog" method.
2. To add new type of log, add a new log class that implements "Log". Set the properties that needs to be logged in "createLog" method.
