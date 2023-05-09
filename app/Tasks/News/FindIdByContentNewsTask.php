<?php 
namespace App\Tasks\News;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\NewsRepository;
use Exception;
use App\Exceptions\NotFoundException;

class FindIdByContentNewsTask extends Task{
    protected NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
    
    public function run($idContent, $columns = ['*'])
    {
        try {
            $idContent = $this->newsRepository->find($idContent, $columns);
        } catch (Exception $ex) {
            throw new NotFoundException(__('common.not_found'));
        }
        return $idContent;
    }  
}
?>