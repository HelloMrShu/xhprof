<?php

namespace gartisan\xhprof;


class Xhprof
{
    /* 
     * function xhprof_start 
     * start to analyze the php code
     */
    public function xhprof_start(){
        xhprof_enable(XHPROF_FLAGS_NO_BUILTINS | XHPROF_FLAGS_CPU | XHPROF_FLAGS_MEMORY);
    }   


    /*  
     * function xhporf_end
     * end to analyze the php code
     * and print the result to file that configured in php.ini
     */
    public function xhprof_end(){

        $xhprof_data = xhprof_disable();                                                                          
        return $xhprof_data;
    }   

    /*
     * function xhprof_display
     * display the data
     */
    public function xhprof_display($data, $host, $source = 'xhprof') {
        
        include_once("xhprof_lib.php");                                                             
        include_once("xhprof_runs.php");                                                            

        $xhprofRuns = new XHProfRuns_Default();    
        $runId = $xhprofRuns->save_run($data, $source);    
                                                                                                                  
        echo $host . $runId . '&source='.$source; 
    }
}
