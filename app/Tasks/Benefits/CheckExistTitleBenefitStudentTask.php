<?php


namespace App\Tasks\Benefits;

use App\Repositories\Contracts\BenefitsRepository;

class CheckExistTitleBenefitStudentTask
{
    protected BenefitsRepository $benefitsRepository;

    public function __construct(BenefitsRepository $benefitsRepository) {
        $this->benefitsRepository = $benefitsRepository;
    }

    public function run($title, $id = null)
    {
        return $this->benefitsRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->where('title', $title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
