# php-job-runner  [![Build Status](https://travis-ci.org/johnroyer/php-job-runner.svg?branch=master)](https://travis-ci.org/johnroyer/php-job-runner)

A simple tool to help you execute routine jobs.


## Example

Create a job extends from `AbstractJob`:

```php
class Cleanner extends \JobRunner\AbstractJob
{
    private $jobId = 'clean-outdated-backup';
    private $runTime = '03:00';

    public function update(\SplSubject $runner)
    {
        // clean outdated backups
    }
}
```

Register your job to runner:

```php
$runner = new JobRunner\Runner();

$runner->attach(new Cleanner);
$runner->attach(new SomeOtherJob);
// ...

$runner->notify();  // runner will notify job which should run at current time
```

trigger runner by Linux crontab:

```bash
$ crontab -e
*/1 * * * *        /usr/bin/php  /path/to/bin/runner.php 2>&1 >/dev/null   // check jobs every minutes
```


# TODO

there is something to improvent:

- support jobs run only once in a week
- job which will block / conflict other jobs
- better time / routine descreption
