<?php


namespace App\Tasks\Config;

use App\Repositories\Contracts\ConfigRepository;

class CheckExistKeyConfigTask
{
    protected ConfigRepository $configRepository;

    public function __construct(ConfigRepository $configRepository) {
        $this->configRepository = $configRepository;
    }

    public function run($key, $id = null)
    {
        return $this->configRepository->scopeQuery(function ($query) use($key, $id) {
            $query = $query->where('key', '=', $key);
            if (!empty($id)) {
                $query = $query->where('id', '!=', $id);
            }
            return $query;
        })->exists();
    }
}
