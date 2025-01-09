<?php

namespace App\View\Components;

use App\Models\Ticket\Ticket;
use App\Models\User\User;
use Generator;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Chat extends Component
{
    public function __construct(
        public Ticket $ticket,
        #[CurrentUser] public User $user,
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function render(): View
    {
        return view('components.chat.index');
    }

    public function comments(): Generator
    {
        foreach ($this->ticket->comments()
                     ->with(['user', 'user.contact'])
                     ->orderByDesc('id')
                     ->get() as $comment) {
            yield $comment;
        }
    }

    public function usersForMention()
    {
        if ($this->user->isClient()) {
            return [
                $this->ticket->manager_id => $this->ticket->manager->fullName,
            ];
        }

        return $this->ticket->client->users()
            ->with(['contact'])
            ->get()
            ->mapWithKeys(fn($user) => [$user->id, $user->fullName]);
    }
}
