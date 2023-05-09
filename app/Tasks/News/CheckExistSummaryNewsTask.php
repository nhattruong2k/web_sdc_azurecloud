<?php
namespace App\Tasks\News;
use App\Repositories\Contracts\NewsRepository;

class CheckExistSummaryNewsTask
{
    protected NewsRepository $newsRepository;
    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }
    public function run($summary, $id = null)
    {
        return $this->newsRepository->scopeQuery(function ($query) use($summary, $id) {
            $query = $query->whereSummary($summary);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
?>
