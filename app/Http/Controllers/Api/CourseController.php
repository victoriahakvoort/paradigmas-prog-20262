<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Resources\CourseResource;
use App\Http\Services\CourseService;
use App\Models\Course;

class CourseController extends Controller
{
    public function __construct(private CourseService $courseService)
    {}

    public function index()
    {
        return CourseResource::collection(
            $this->courseService->index(Course::query())
        );
    }

    public function store(CourseRequest $request)
    {
        return new CourseResource(
            $this->courseService->store($request->validated())
        );
    }

    public function show(string $id)
    {
        return new CourseResource(
            $this->courseService->show($id)
        );
    }

    public function update(CourseRequest $request, string $id)
    {
        return new CourseResource(
            $this->courseService->update($request->validated(), $id)
        );
    }

    public function destroy(string $id)
    {
        $this->courseService->destroy($id);

        return response()->noContent();
    }
}
