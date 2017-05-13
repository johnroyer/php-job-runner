<?php

namespace JobRunner;

abstract class AbstractJob implements \SplObserver
{
    /** @var string unique ID of job */
    protected $jobId = '';

    /** @var string run time in 24H format */
    protected $runTime = '';

    public function getId()
    {
        return $this->jobId;
    }

    public function getRunTime()
    {
        return $this->runTime;
    }
}
