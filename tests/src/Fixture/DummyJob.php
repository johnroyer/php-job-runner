<?php

namespace JobRunner\Test\Fixture;

class DummyJob extends \JobRunner\AbstractJob
{
    protected $jobId = 'my-job';

    protected $runTime = '12:00';

    public function update(\SplSubject $runner)
    {
        return '123';
    }
}