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
        $command = "cd .. && $(which git) pull";
        // $command = "cd .. && where git pull";
        // $command = "cd .. && git pull";
        // $command = "cd .. && git status";
        $output = array();
        $returnValue = null;
        
        // shell_exec($command, $output, $returnValue);
        
        // if ($returnValue === 0) {
        //     // Command executed successfully
        //     foreach ($output as $line) {
        //         echo $line . "<br>";
        //     }
        // } else {
        //     // Command execution failed
        //     echo "Command failed with error code: " . $returnValue;
        // }

        
        $output=shell_exec($command);
        if ($output !== null) {
            echo "Current working directory: " . $output;
        } else {
            echo "Command execution failed.";
        }
    }
}
