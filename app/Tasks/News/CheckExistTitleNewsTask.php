<?php
namespace App\Tasks\News;
use App\Repositories\Contracts\NewsRepository;

class CheckExistTitleNewsTask
{
    protected NewsRepository $newsRepository;
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
    public function run($title, $id = null)
    {
        return $this->newsRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->whereTitle($title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
?>
