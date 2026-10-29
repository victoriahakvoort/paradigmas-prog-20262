<?php

namespace App\Http\Repositories;

use App\Models\Classroom;

class ClassroomRepository extends BaseRepository
{
    public function __construct(private Classroom $model)
    {
        parent::__construct($model);
    }

    public function getWithFilters(array $data)
    {
        $builder = $this->model->query()
            ->with('course')
            ->where(function ($query) use ($data) {
                if (data_get($data, 'name')) {
                    $query->where('name', 'like', '%' . $data['name'] . '%');
                }
            });

        return $this->index($builder);
    }

    public function manageUser(int $classroomId, int $userId, string $action)
    {
        $classroom = $this->model->findOrFail($classroomId);

        if ($action === 'add') {
            $classroom->users()->syncWithoutDetaching([$userId]);
        } else {
            $classroom->users()->detach($userId);
        }

        return $classroom->load('users');
    }
    public function show(string $id)
    {
        return $this->model
            ->with('course')
            ->findOrFail($id);
    }
}