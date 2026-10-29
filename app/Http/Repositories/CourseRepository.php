<?php

namespace App\Http\Repositories;

use App\Models\Course;

class CourseRepository extends BaseRepository
{
    public function __construct(private Course $model)
    {
        parent::__construct($model);
    }

    public function index(\Illuminate\Database\Eloquent\Builder $builder)
    {
        return parent::index($builder->with('classrooms'));
    }

    public function show(string $id)
    {
        return $this->model->with('classrooms')->findOrFail($id);
    }
}