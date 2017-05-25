<?php

namespace Routine\Job;

class CleanCache extends \JobRunner\AbstractJob
{
    protected $jobId = 'clean-cache';

    protected $runTime = '0 3 * * *';

    public function update(\SplSubject $runner)
    {
        foreach (scandir(__DIR__ . '/../../cahce') as $file) {
            unlink($file);
        }
    }
}
