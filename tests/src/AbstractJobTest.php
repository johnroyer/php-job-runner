<?php

namespace JobRunner\Test;

use PHPUnit\Framework\TestCase;

class AbstractJobTest extends TestCase
{
    private $job;

    public function setUp()
    {
        $this->job = new \JobRunner\Test\Fixture\DummyJob;
    }

    public function tearDown()
    {
        $this->job = null;
    }

    public function testJobIdGetter()
    {
        $this->assertSame(
            'my-job',
            $this->job->getId(),
            'failed to get job ID'
        );
    }

    public function testRunTimeGetter()
    {
        $this->assertSame(
            '12:00',
            $this->job->getRunTime(),
            'failed to get run time'
        );
    }
}
