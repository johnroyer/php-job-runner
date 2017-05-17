<?php

namespace JobRunner;

abstract class AbstractJob implements \SplObserver
{
    /** @var string unique ID of job */
    protected $jobId = '';

    /**
     * @var string run time in Unix cron format
     *
     * for example: '0 18 * * *' to run in every day at 18:00
     */
    protected $runTime = '';

    /** @var Cron\CronExpression created automatically. Do NOT touch. */
    private $cron = null;

    public function getId()
    {
        return $this->jobId;
    }

    public function getRunTime()
    {
        return $this->runTime;
    }
}
