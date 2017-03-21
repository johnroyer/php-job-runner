<?php

namespace JobRunner;

class Runner implements \SplSubject
{
    /** @var array time (in 24h format) as key, job ID as value */
    private $schedule = [];

    /** @var array job ID as key, run time as value */
    private $timeMap = [];

    /** @var \DateTimeImmutable bootstrap time in 24h format */
    private $currTime = null;

    /**
     * Constructor
     *
     * @param \DateTimeImmutable the time runner has been boot up
     */
    public function __construct(\DateTimeImmutable $currTime)
    {
        $this->currTime = $currTime;
    }

    /**
     * Get runner boot up time
     *
     * @return \DateTimeImmutable
     */
    public function getBootupTime()
    {
        return $this->currTime;
    }

    /**
     * attach job observer
     *
     * @param \SplObserver job which will run
     */
    public function attach(\SplObserver $job)
    {
        // check if job ID is unique
        if (in_array($job->getId, array_keys($this->timeMap))) {
            throw  new \UnexpectedValueException(
                'Duplicated job ID. Job ID should be unique.'
            );
        }
    }

    /**
     * Push job into schedule
     *
     * @param AbstractJob job instance
     */
    private function pushSchedule($job)
    {
        $runTime = $job->getRunTime();

        if (array_key_exists($runTime, $this->schedule)) {
            $this->schedule = [$runTime => $job];
        } else {
            $this->schedule[$runTime][] = $job;
        }
    }

    private function updateTimeMap($job)
    {
        $this->timeMap[$job->getId] = $job->getRunTime();
    }

    /**
     * Get current schedule
     *
     * @return array schedule list
     */
    public function getSchedule()
    {
        $list = [];

        foreach ($this->schedule as $time => $jobs) {
            foreach ($jobs as $job) {
                $list[$time][] = $job->getId;
            }
        }

        return $list;
    }

    public function detach(\SplObserver $job)
    {
    }

    public function notify()
    {
    }
}
