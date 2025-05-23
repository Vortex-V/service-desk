<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use Arr;
use Illuminate\Http\RedirectResponse;

final class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usersPaginator = User::with(['contact', 'client'])
            ->whereNot('role', UserRole::Admin)
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.user.index', compact('usersPaginator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $user = User::factory()->makeOne();
        $user->fill($request->validated());
        $user->save();

        return redirect()->route('users.contacts.create', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $client_id = Arr::get($validated, 'client_id');
        Arr::forget($validated, 'client_id');
        $user->fill(Arr::except($validated, ['client_id']));
        if ($client_id) {
            $user->client_id = $client_id;
        }
        $user->save();

        return redirect()->route('users.show', [$user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return back();
    }
}
