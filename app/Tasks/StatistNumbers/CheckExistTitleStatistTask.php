<?php
namespace App\Tasks\StatistNumbers;
use App\Repositories\Contracts\StatistNumbersRepository;

class CheckExistTitleStatistTask
{
    protected StatistNumbersRepository $statistNumbersRepository;
    public function __construct(StatistNumbersRepository $statistNumbersRepository)
    {
        $this->statistNumbersRepository = $statistNumbersRepository;
    }

    public function run($title, $id = null)
    {
        return $this->statistNumbersRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->whereTitle($title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
?>
