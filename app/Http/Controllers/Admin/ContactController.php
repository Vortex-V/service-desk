<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\Contact\StoreContactRequest;
use App\Http\Requests\Admin\User\Contact\UpdateContactRequest;
use App\Models\User\Contact;
use App\Models\User\User;
use Arr;
use Illuminate\Http\RedirectResponse;

final class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactsPaginator = Contact::paginate();

        return view('admin.contact.index', compact('contactsPaginator'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        return view('admin.contact.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContactRequest $request): RedirectResponse
    {
        $contact = Contact::factory()->makeOne();
        $contact->fill(
            Arr::except($request->validated(), ['user_id'])
        );
        $contact->user_id = $request->integer('user_id');
        $contact->save();

        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Contact $contact)
    {
        return view('admin.contact.edit', compact('user', 'contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactRequest $request, User $user, Contact $contact): RedirectResponse
    {
        $contact->fill($request->validated());
        $contact->save();

        return redirect()->route('users.show', [$user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact): RedirectResponse
    {
        $contact->delete();

        return back();
    }
}
