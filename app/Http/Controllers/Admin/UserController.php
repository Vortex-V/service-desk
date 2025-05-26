<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreUserRequest;
use App\Http\Requests\Admin\User\UpdateUserRequest;
use App\Models\Client\Client;
use App\Models\User\Contact;
use App\Models\User\Enum\UserRole;
use App\Models\User\User;
use App\Models\User\UserSearch;
use App\Service\ExcelExportService;
use App\Service\ExcelImportService;
use Arr;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

final class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View|Application|Factory
    {
        /** @var UserSearch $search */
        $search = app(UserSearch::class);
        $usersPaginator = $search
            ->load()
            ->withoutAdmin()
            ->search();

        session()?->flashInput(request()->input());

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

    public function export(User $user): StreamedResponse
    {
        /** @var UserSearch $search */
        $search = app(UserSearch::class);
        $users = $search->withoutAdmin()->search();
        /** @var ExcelExportService $excelService */
        $excelService = app(ExcelExportService::class, [
            'data' => $user,
            'settings' => [
                [
                    'attribute' => 'id',
                    'label' => 'ID',
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email',
                ],
                [
                    'attribute' => 'role',
                    'value' => static fn(User $user) => UserRole::label($user->role),
                    'label' => 'Роль',
                ],
                [
                    'attribute' => 'client.name',
                    'label' => 'Название клиента',
                ],
                [
                    'attribute' => 'contact.last_name',
                    'label' => 'Фамилия',
                ],
                [
                    'attribute' => 'contact.first_name',
                    'label' => 'Имя',
                ],
                [
                    'attribute' => 'contact.patronymic',
                    'label' => 'Отчество',
                ],
                [
                    'attribute' => 'contact.phone',
                    'label' => 'Номер телефона',
                ],
            ]
        ]);
        $writer = $excelService->export();

        $fileName = "user_{$user->id}_export.xlsx";
        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }

    public function exportCollection(): StreamedResponse
    {
        /** @var UserSearch $search */
        $search = app(UserSearch::class);
        $collection = $search
            ->load()
            ->withoutAdmin()
            ->collection();
        /** @var ExcelExportService $excelService */
        $excelService = app(ExcelExportService::class, [
            'data' => $collection,
            'settings' => [
                [
                    'attribute' => 'id',
                    'label' => 'ID',
                ],
                [
                    'attribute' => 'email',
                    'label' => 'Email',
                ],
                [
                    'attribute' => 'role',
                    'value' => static fn(User $user) => UserRole::label($user->role),
                    'label' => 'Роль',
                ],
                [
                    'attribute' => 'client.name',
                    'label' => 'Название клиента',
                ],
                [
                    'attribute' => 'contact.last_name',
                    'label' => 'Фамилия',
                ],
                [
                    'attribute' => 'contact.first_name',
                    'label' => 'Имя',
                ],
                [
                    'attribute' => 'contact.patronymic',
                    'label' => 'Отчество',
                ],
                [
                    'attribute' => 'contact.phone',
                    'label' => 'Номер телефона',
                ],
            ]
        ]);
        $writer = $excelService->exportCollection();

        $fileName = "users_export.xlsx";
        return response()->streamDownload(function() use ($writer) {
            $writer->save('php://output');
        }, $fileName);
    }

    public function import(): View|Application|Factory
    {
        return view('admin.user.import');
    }

    public function importCollection()
    {
        $file = request()->file('file');

        $data = ExcelImportService::import($file);

        $data->shift();
        $data->map(function ($item) {
            $client = Client::where('name', $item['client_name'])->firstOrFail();

            $user = User::factory()
                ->state([
                    'email' => $item['email'],
                    'role' => UserRole::Client
                ])
                ->hasAttached($client, relationship: 'client')
                ->makeOne();
            $user->save();

            $contact = Contact::factory()
                ->state([
                    'last_name' => $item['last_name'],
                    'first_name' => $item['first_name'],
                    'patronymic' => $item['patronymic'],
                    'phone' => $item['phone'],
                ])
                ->hasAttached($user, relationship: 'user')
                ->createOne();
        });

        return redirect()->route('users.index')->withInput();
    }
}
