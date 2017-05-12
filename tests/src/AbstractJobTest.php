<?php

namespace JobRunner\Test;

use PHPUnit\Framework\TestCase;
use JobRunner\AbstractJob;

abstract class AbstractJobTest extends TestCase
{
    /** @var \JobRunner\AbstractJob job instance */
    private $job;

    /** @var \ReflectionClass class reflection for testing */
    private $refc;

    public function setUp($jobName)
    {
        $this->job = new $jobName();
    }

    public function tearDown()
    {
        $this->job = null;
    }

    public function testJobIdIsString()
    {
        $refc = new \ReflectionClass($this->job);
        $id = $refc->getProperty('jobId');
        $id->setAccessible(true);

        $this->assertSame(
            true,
            is_string($id->getValue()),
            'job ID shoud be string'
        );
    }

    public function testRunTimeIsString()
    {
        $refc = new \ReflectionClass($this->job);
        $id = $refc->getProperty('runTime');
        $id->setAccessible(true);

        $this->assertSame(
            true,
            is_string($id->getValue()),
            'runTime shoud be string'
        );

        return $id->getValue();
    }

    /**
     * @depends testRunTimeIsString
     */
    public function testRuntTimeFormatIsCorrect($runTime)
    {
        // run time should present in 24H format
        $this->assertSame(
            1,
            preg_match('/[\d]{2}:[\d]{2}/', $runTime),
            'runTime should use 24H format'
        );
    }
}
