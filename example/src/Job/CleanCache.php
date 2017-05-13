<?php

namespace Routine\Job;

class CleanCache extends \JobRunner\AbstractJob
{
    private $jobId = 'clean-cache';

    private $runTime = '03:00';

    public function update(\SplSubject $runner)
    {
        foreach (scandir(__DIR__ . '/../../cahce') as $file) {
            unlink($file);
        }
    }
}
