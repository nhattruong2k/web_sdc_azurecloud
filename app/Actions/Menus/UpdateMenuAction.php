<?php

namespace App\Actions\Menus;

use App\Cores\Abstracts\Action;
use App\SubActions\Menus\UploadImageMenuSubAction;
use App\Tasks\Menus\FindMenuByIdTask;
use App\Tasks\Menus\UpdateMenuTask;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UpdateMenuAction extends Action
{
    public function run(int $id, Request $request)
    {
        $menu = resolve(FindMenuByIdTask::class)->run($id);
        $data = $request->all();
        $data['status'] = isset($data['status']) ? 1 : 0;
        $menu->title != $data['title'] ? $data['slug'] = Str::slug($data['title']) : $data['slug'] = $menu->slug;
        $menu = resolve(UpdateMenuTask::class)->run($data, $id);
        return $menu;
    }
}
