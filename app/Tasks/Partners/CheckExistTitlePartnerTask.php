<?php


namespace App\Tasks\Partners;

use App\Repositories\Contracts\PartnersRepository;

class CheckExistTitlePartnerTask
{
    protected PartnersRepository $partnersRepository;

    public function __construct(PartnersRepository $partnersRepository) {
        $this->partnersRepository = $partnersRepository;
    }

    public function run($title, $id = null)
    {
        return $this->partnersRepository->scopeQuery(function ($query) use($title, $id) {
            $query = $query->where('title', '=', $title);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
