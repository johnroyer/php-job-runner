<?php

namespace JobRunner;

use \Cron\CronExpression as CronExp;

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

    private function initCron()
    {
        if (null !== $this->cron) {
            return;
        }

        // do NOT catch exception.
        // exception should be fixed before push to production
        $this->cron = CronExp::factory($this->runTime);
    }

    public function getRunTime()
    {
        $this->initCron();

        return $this->cron
            ->getNextRunDate()
            ->format('Y/m/d H:i');
    }
}
