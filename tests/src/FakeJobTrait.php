<?php

namespace JobRunner\Test;

Trait FakeJobTrait
{
    public function getFakeJob($id, $runTime)
    {
        $job = \Mockery::mock(\JobRunner\AbstractJob::class.'[getId,getRunTime]');

        $job->shouldReceive('getId')
            ->andReturn($id);

        $job->shouldReceive('getRunTime')
            ->andReturn($runTime);

        $runner = null;
        $job->shouldReceive('update')
            ->with($runner)
            ->andReturn($runner);

        return $job;
    }
}