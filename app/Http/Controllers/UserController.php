<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\WithExportImport;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Support\Response\ApiResponse;

class UserController extends Controller
{
    use WithExportImport;

    public function __construct(protected UserRepository $repository) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = $this->repository->table(request()->mergeIfMissing([
            'sortBy' => 'updated_at',
            'sortDirection' => 'desc',
            'perPage' => 100,
        ]));

        return ApiResponse::make($result);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $model = $this->repository->store($request->validated());

        return ApiResponse::data($model);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $model = $this->repository->toArray($user/* ->loadMissing('roles.permissions') */);

        return ApiResponse::data($model);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $model = $this->repository->edit($request->validated(), $user);

        return ApiResponse::data($model);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->repository->destroy($user);

        return ApiResponse::data();
    }
}
