<?php

abstract class LoggerFactory
{
    /**
     * 
     * @param type $type
     * @return \Logger
     * @throws UnexpectedValueException
     */
    public static function getLogger( $type = 'csv' )
    {
        $logger = null;
        switch ( $type ) {
            case 'csv':
                    $logger = new CsvLogger();
                break;
            
            case 'mysql':
                    $logger = new AnyOtherLogger();
                break;
            
            default:
                throw new UnexpectedValueException( 'Invalid Logger type requested' );
        }
        
        return $logger;
    }
}
