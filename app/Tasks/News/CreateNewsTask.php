<?php 
namespace App\Tasks\News;
use Exception;
use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\NewsRepository;

class CreateNewsTask extends Task {
    protected NewsRepository $newsRepository;
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function run(array $data)
    {   
        try {
            $news = $this->newsRepository->create($data);
            Cache::delete(Constants::$fileName['new']);
        } catch (Exception $ex) {
            throw new InternalErrorException(__('news.create_error'));
        }
        return $news;
    }
}
?>