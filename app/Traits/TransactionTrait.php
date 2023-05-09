<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait TransactionTrait
{
    protected function beginTransaction()
    {
        DB::beginTransaction();
    }

    protected function commit()
    {
        DB::commit();
    }

    protected function rollback()
    {
        DB::rollBack();
    }
}
