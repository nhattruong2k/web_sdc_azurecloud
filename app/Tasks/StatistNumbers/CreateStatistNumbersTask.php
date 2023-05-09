<?php 
namespace App\Tasks\StatistNumbers;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StatistNumbersRepository;
use App\Exceptions\InternalErrorException;
use Exception;

class CreateStatistNumbersTask extends Task {
    protected StatistNumbersRepository $statistNumbersRepository;
    public function __construct(StatistNumbersRepository $statistNumbersRepository)
    {
        $this->statistNumbersRepository = $statistNumbersRepository;
    }
    
    public function run(array $data)
    {   
        try {
            $numbers= $this->statistNumbersRepository->create($data);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('statistnumber.create_error'));
        }
        return $numbers;
    }
}
?>