<x-layout.app title="Мои заявки">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1>Мои заявки</h1>
                    @unless(Gate::allows('admin'))
                        <a href="{{route('tickets.create')}}" class="btn btn-primary float-end">Создать заявку</a>
                    @endunless
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    @php
                        // TODO use GridView
                        $columns = [
                            'id' => 'ID',
                            'status' => 'Статус',
                        ];
                    @endphp
                    <x-bs.table.table>
                        <x-bs.table.head :columns="$columns"/>
                        @foreach($ticketsPaginator as $ticket)
                            <x-bs.table.row :route="route('tickets.show', $ticket)" :columns="$columns" :data="$ticket"/>
                        @endforeach
                    </x-bs.table.table>
                    {{ $ticketsPaginator->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout.app>
