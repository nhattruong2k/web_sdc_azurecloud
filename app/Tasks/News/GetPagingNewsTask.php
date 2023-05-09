<?php

namespace App\Tasks\News;

use App\Actions\Category\FindCategoryBySlugAction;
use App\Helpers\Cache;
use App\Libs\Constants;
use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\NewsRepository;

class GetPagingNewsTask extends Task
{

    protected NewsRepository $newsRepository;

    public function __construct(NewsRepository $newsRepository)
    {
        $this->newsRepository = $newsRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'news.id',
            'news.title',
            'news.slug',
            'news.summary',
            'news.content',
            'news.image',
            'news.views',
            'news.feature',
            'news.status',
            'news.user_id',
            'news.category_id',
            'news.created_at',
            'news.keyword',
        ];
        $news = $this->newsRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('news.title', 'like', "%" . $param['search'] . "%");
            }

            if ((isset($param['keyword']) && $param['keyword'])) {
                $query->where('news.keyword', 'like', "%" . $param['keyword'] . "%");
            }

            if(!empty($param['category_id'])){
                $query->where('news.category_id', $param['category_id']);
            }

            if($param['isClient'] == true && (empty($param['category_id']) || $param['category_id'] != 999)){
                $query->whereNotIn('news.category_id', [999]);
            }
            
            if(!empty($param['slug_category'])){
                $category = resolve(FindCategoryBySlugAction::class)->run($param['slug_category'], 'id');
                $query->where('news.category_id', $category->id);   
            }
            if (!empty($param['status'])) {
                $query->where('news.status', $param['status']);
            }

            if (!empty($param['feature'])) {
                $query->where('news.feature', $param['feature']);
            }

            $query->with('categories:id,title');
            $query->with('users:id,name');
            return $query;
        });
        if(empty(Cache::read(Constants::$fileName['new']))){
            Cache::write(Constants::$fileName['new'], $this->newsRepository->active()->select($columns)->get());
        }
        $news->orderBy($param['sortfield'], $param['sorttype']);
        return $news->paginate($param['limit'], $columns);
    }
}
