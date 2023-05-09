<?php 
namespace App\Tasks\News;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\NewsRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindNewsByIdTask extends Task{
    protected NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
    
    public function run(int $id, $columns = ['*'])
    {
        try {
            $status = $this->newsRepository->find($id, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $status;
    }  
}
?>