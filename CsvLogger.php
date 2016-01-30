<?php

class CsvLogger extends Logger
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
            $handle = fopen( $filename, "a+" );
            // no need to read title  $title  = fgetcsv($handle);
            // write log body
            fputcsv( $handle, $logArray );
            fclose( $handle );
        }
        else{
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