<?php

namespace JobRunner\Test\Fixture;

class DummyYearlyJob extends \JobRunner\AbstractJob
{
    protected $jobId = 'my-job';

    protected $runTime = '0 0 1 1 *';

    public function update(\SplSubject $runner)
    {
        return '123';
    }
}