<?php

/**
 * A class that writes any Log (UserLog, ErrorLog or any log which implements 
 * interface Log) to a csv file.
 */
class CsvLogger implements Logger
{
    /**
     * CSV line endings may behave differently depending on Operating System
     * 
     * If line endings in csv file is not formatted as required, use:
     * ini_set("auto_detect_line_endings", true);
     * 
     * @param \Log $log
     */
    public function writeLog( \Log $log )
    {
        $logConfig = new LogConfig();
        $logType    = get_class( $log );
        $filename   = 'logs/'.$logType.'-'. gmdate( 'Ymd' ) .'.csv';
        
        $logArray = $this->getArray( $log );
        ksort( $logArray );
        
        if ( file_exists( $filename ) ) {
            // After first entry is done, we simple append the contents
            $handle = fopen( $filename, "a+" );
            // write log body
            fputcsv( $handle, $logArray );
            fclose( $handle );
        }
        else{
            // For first entry, we need titles in CSV file
            $title  = array_keys( $logArray );
            $handle = fopen( $filename,"a+" );
            fputcsv( $handle, $title );
            fputcsv( $handle, $logArray );
            fclose( $handle );
        }
    }
    
    protected function getArray( $obj )
    {
        foreach ( $obj as $key => $value ){
            $array[ $key ]  = $value;
        }
        return $array;
    }
}