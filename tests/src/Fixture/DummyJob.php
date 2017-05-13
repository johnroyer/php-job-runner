<?php

namespace JobRunner\Test\Fixture;

class DummyJob extends \JobRunner\AbstractJob
{
    private $jobId = 'my-job';

    private $runTime = '12:00';

    public function update(\SplSubject $runner)
    {
        return '123';
    }
}