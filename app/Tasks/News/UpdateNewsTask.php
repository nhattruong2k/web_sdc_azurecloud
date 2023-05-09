<?php 

namespace App\Tasks\News;
use Exception;
use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Exceptions\NotFoundException;
use App\Exceptions\InternalErrorException;
use App\Repositories\Contracts\NewsRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateNewsTask extends Task {
    protected NewsRepository $newsRepository;
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function run($data, int $newId)
    {
        if (empty($data)) {
            throw new InternalErrorException(__('common.inputs_empty'));
        }
        try {   
            $news = $this->newsRepository->update($data, $newId);
            Cache::delete(Constants::$fileName['new']);
        } catch (ModelNotFoundException $ex) {
            throw new NotFoundException(__('common.not_found'));
        } catch (Exception $ex) {
            throw new InternalErrorException(__('category.update_error'));
        }
        return $news;
    }
}
?>