<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function git_pull() 
    {
        $command = "cd .. && git pull";

        try {
            // Create a new Process instance with the Git pull command
            $process = new Process(explode(' ', $command));

            // Run the command
            $process->mustRun();

            // If the command runs successfully, you can optionally get the output
            // $output = $process->getOutput();

            return 'true'; // Git pull was successful
        } catch (ProcessFailedException $exception) {
            // If the command fails, you can get the error output for debugging
            // $errorOutput = $exception->getProcess()->getErrorOutput();
            return 'false'; // Git pull failed
        }
    }
}
