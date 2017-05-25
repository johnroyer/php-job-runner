<?php

namespace JobRunner\Test;

use PHPUnit\Framework\TestCase;

class AbstractJobTest extends TestCase
{
    private $job;

    public function setUp()
    {
        $this->job = new \JobRunner\Test\Fixture\DummyYearlyJob;
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
        $res = preg_match('/01\/01 00:00/', $this->job->getRunTime(new \DateTimeImmutable('5566/1/1 00:00')));

        $this->assertSame(
            1,
            $res,
            'failed to get run time'
        );
    }

    public function testCronInitilizer()
    {
        $this->job->getRunTime(new \DateTimeImmutable('5566/1/1 00:00'));
        $res = preg_match('/01\/01 00:00/', $this->job->getRunTime(new \DateTimeImmutable('5566/1/1 00:00')));

        $this->assertSame(
            1,
            $res,
            'failed to get run time'
        );
    }
}
