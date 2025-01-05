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
                        @include('ticket.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout.app>
