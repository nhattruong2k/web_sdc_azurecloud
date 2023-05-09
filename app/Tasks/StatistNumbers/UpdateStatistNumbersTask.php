<?php 

namespace App\Tasks\StatistNumbers;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\StatistNumbersRepository;
use App\Exceptions\InternalErrorException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\NotFoundException;

class UpdateStatistNumbersTask extends Task {
    protected StatistNumbersRepository $statistNumbersRepository;
    public function __construct(StatistNumbersRepository $statistNumbersRepository)
    {
        $this->statistNumbersRepository = $statistNumbersRepository;
    }

    public function run($data, int $numbersId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {
            $numbers= $this->statistNumbersRepository->update($data, $numbersId);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('statistnumber.update_error'));
        }
        return $numbers;
    }
}
?>