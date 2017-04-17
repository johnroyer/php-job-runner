<?php

namespace JobRunner;

abstract class AbstractJob implements \SplObserver
{
    /** @var string unique ID of job */
    private $jobId = '';

    /** @var string run time in 24H format */
    private $runTime = '';

    public function getId()
    {
        return $this->jobId;
    }

    public function getRunTime()
    {
        return $this->runTime;
    }
}
