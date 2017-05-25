<?php

namespace Routine\Job;

class SysMonitor extends \JobRunner\AbstractJob
{
    protected $jobId = 'sys-monitor';
    
    protected $runTime = '0 21 * * *';

    public function update(\SplSubject $runner)
    {
        file_put_contents(__DIR__ . '/../../log/sys.log', exec('uptime'), FILE_APPEND);
    }
}