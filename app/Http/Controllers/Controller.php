<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function git_pull()  
    {
        // $command = "cd .. && $(which git) pull";
        // $command = "cd .. && where git pull";
        $command = "cd .. && git pull";
        $output = array();
        $returnValue = null;
        
        exec($command, $output, $returnValue);
        
        if ($returnValue === 0) {
            // Command executed successfully
            foreach ($output as $line) {
                echo $line . "<br>";
            }
        } else {
            // Command execution failed
            echo "Command failed with error code: " . $returnValue;
        }
    }
}
