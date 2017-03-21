<?php

namespace JobRunner;

abstract class AbstractJob implements \SplObserver
{
    /** @var string run time in 24H format */
    private $runTime = '';
}
