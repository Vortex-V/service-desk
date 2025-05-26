<?php

declare(strict_types=1);

$title = "Импорт пользователей";
?>

<x-layout.app :title="$title">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1>{{ $title }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form
                            method="post"
                            action="{{route('users.import-collection')}}"
                            enctype="multipart/form-data"
                        >
                            @csrf()
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Выберите XLSX файл для импорта</label>
                                <input class="form-control" type="file" id="formFile" name="file" required>
                            </div>
                            <div class="col-12 text-end">
                                <button class="btn btn-primary" type="submit">Импортировать</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layout.app>
