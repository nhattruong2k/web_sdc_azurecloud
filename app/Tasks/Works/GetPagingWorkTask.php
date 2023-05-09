<?php

namespace App\Tasks\Works;

use App\Cores\Abstracts\Task;
use App\Repositories\Contracts\WorksRepository;

class GetPagingWorkTask extends Task
{

    protected WorksRepository $worksRepository;

    public function __construct(WorksRepository $worksRepository)
    {
        $this->worksRepository = $worksRepository;
    }

    public function run(array $param, array $columns = ['*'])
    {
        $columns = [
            'works.id',
            'works.title',
            'works.slug',
            'works.image',
            'works.time',
            'works.degree',
            'works.object',
            'works.course_category_id',
            'works.description',
            'works.content',
            'works.status',
            'works.keyword',
        ];

        $works = $this->worksRepository->scopeQuery(function ($query) use ($param) {
            if ((isset($param['search']) && $param['search'])) {
                $query->where('works.title', 'like', "%" . $param['search'] . "%");
            }

            if((isset($param['category_course']) && $param['category_course'])){
                $query->where('works.course_category_id', $param['category_course'])->where('works.title', 'like', "%" . $param['search'] . "%");
            }

            if (!empty($param['course_category_id'])) {
                $query->where('works.course_category_id', $param['course_category_id']);
            }

            if (!empty($param['keyword'])) {
                $query->where('works.keyword', 'like', "%" . $param['keyword'] . "%");
            }

            if (!empty($param['status'])) {
                $query->where('works.status', $param['status']);
            }
            $query->with('courseCategory:id,title,image');
            return $query;
        });
        $works->orderBy($param['sortfield'], $param['sorttype']);
        return $works->paginate($param['limit'], $columns);
    }
}
