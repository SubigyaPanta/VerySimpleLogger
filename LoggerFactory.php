<?php

abstract class LoggerFactory
{
    /**
     * To get the type of logger you want. 
     * If you want to add a new logging method, for eg, using Mysql database,
     * create a new class MysqlLogger which extends Logger and 
     * add a "case" mysql. Thats it.
     * 
     * @param type $type
     * @return \Logger
     */
    public static function getLogger( $type = 'csv' )
    {
        $logger = null;
        switch ( $type ) {
            case 'csv':
                    $logger = new CsvLogger();
                break;
            
            case 'other':
                    $logger = new AnyOtherLogger();
                break;
            
            default:
                $logger = new CsvLogger();
        }
        
        return $logger;
    }
}
