<?php

namespace Routine\Job;

class SysMonitor extends \JobRunner\AbstractJob
{
    private $jobId = 'sys-monitor';
    
    private $runTime = '21:00';

    public function update(\SplSubject $runner)
    {
        file_put_contents(__DIR__ . '/../../log/sys.log', exec('uptime'), FILE_APPEND);
    }
}