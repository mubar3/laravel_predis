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
        // $command = "cd .. && git pull";
        // $command = "cd .. && git status";
        $repoPath = '/var/www/html/laravel_predis';
        $gitPath = '/usr/bin/git'; // Replace this with the correct path to your git executable

        
        // Enable error reporting for troubleshooting
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // $command = "cd $repoPath && $gitPath pull";
        $command = "cd $repoPath && cd";
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

        
        // $output=shell_exec($command);
        // if ($output !== null) {
        //     echo "Current working directory: " . $output;
        // } else {
        //     echo "Command execution failed.";
        // }
    }
}
