<?php 
namespace App\Tasks\StatistNumbers;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StatistNumbersRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindStatistNumbersByIdTask extends Task{
    protected StatistNumbersRepository $statistNumbersRepository;
    public function __construct(StatistNumbersRepository $statistNumbersRepository)
    {
        $this->statistNumbersRepository = $statistNumbersRepository;
    }

    
    public function run(int $id, $columns = ['*'])
    {
        try {
            $status = $this->statistNumbersRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $status;
    }
}
?>