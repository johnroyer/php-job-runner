<?php

namespace JobRunner\Test;

use PHPUnit\Framework\TestCase;
use JobRunner\Runner;

class RunnerTest extends TestCase
{
    use \JobRunner\Test\FakeJobTrait;

    private $runner = null;

    public function setUp()
    {
        $this->runner = new Runner(new \DateTimeImmutable());
    }

    public function tearDown()
    {
        $this->runner = null;
    }

    public function testInitialTime()
    {
        $this->runner = new Runner(new \DateTimeImmutable('2017/01/01'));

        $this->assertEquals(
            '2017/01/01',
            $this->runner->getBootupTime()->format('Y/m/d'),
            'Initial time of Runner should not be changed'
        );
    }

    public function testEmptySchedule()
    {
        $this->assertSame(
            true,
            is_array($this->runner->getSchedule()),
            'output schedule should be an array'
        );
    }

    public function testAddOneJob()
    {
        $job = $this->getFakeJob('job-1', '12:00');

        $this->runner->attach($job);

        return $this->runner;
    }

    /**
     * @depends testAddOneJob
     */
    public function testTimeSchedule($runner)
    {
        $sch = $runner->getSchedule();

        $this->assertEquals(true, array_key_exists('12:00', $sch));
    }

    /**
     * @depends testAddOneJob
     */
    public function testJobInSchdule($runner)
    {
        $sch = $runner->getSchedule();

        $this->assertEquals(true, in_array('job-1', $sch['12:00']));
    }

    public function testRunnerTrigger()
    {
        $this->runner = new Runner(new \DateTimeImmutable('2017/01/01 12:00'));

        $job = $this->getFakeJob('job', '12:00');
        $job->shouldReceive('update')
            ->once();

        $this->runner->attach($job);

        $this->runner->notify();
    }

    public function testRunnerTriggerNothing()
    {
        $this->runner->notify();
    }

    public function testAttachOneJob()
    {
        $job = $this->getFakeJob('job', '12:00');

        $this->runner->attach($job);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testAttachJobsWithDuplicateID()
    {
        $job = $this->getFakeJob('job', '12:00');

        $this->runner->attach($job);
        $this->runner->attach($job);
    }

    public function testAttachDiferentJobsExecuteInSameTime()
    {
        $job = $this->getFakeJob('foo', '12:00');
        $job2 = $this->getFakeJob('bar', '12:00');

        $this->runner->attach($job);
        $this->runner->attach($job2);
    }
}
