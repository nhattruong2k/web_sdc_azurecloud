<?php

namespace App\Cores\Abstracts;

use \App\Traits\TransactionTrait;

abstract class Action
{
    use TransactionTrait;
}

