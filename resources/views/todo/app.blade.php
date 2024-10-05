<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App - Data produk</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom styles */
        body {
            background-color: #e3f2fd;
        }

        .navbar {
            background-color: #1e88e5;
        }

        h1 {
            color: #1e88e5;
        }

        .card {
            border: 1px solid #64b5f6;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.1);
        }

        .card-body {
            background-color: #e8f5e9;
        }

        .btn-primary {
            background-color: #42a5f5;
            border-color: #42a5f5;
        }

        .btn-primary:hover {
            background-color: #1e88e5;
            border-color: #1e88e5;
        }

        .btn-secondary {
            background-color: #66bb6a;
            border-color: #66bb6a;
        }

        .btn-secondary:hover {
            background-color: #43a047;
            border-color: #43a047;
        }

        .list-group-item {
            background-color: #ffffff;
            border: 1px solid #42a5f5;
        }

        .input-group .form-control {
            border-color: #42a5f5;
        }

        .edit-btn, .delete-btn {
            background-color: #29b6f6;
            border: none;
        }

        .edit-btn:hover {
            background-color: #0288d1;
        }

        .delete-btn:hover {
            background-color: #ef5350;
        }

        .collapse {
            background-color: #f1f8e9;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <!-- 00. Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid col-md-7">
            <a href="/" class="navbar-brand">Crud Simple</a>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- 01. Content -->
        <h1 class="text-center mb-4">Data Produk</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success ">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <p>
                                @foreach ($errors->all() as $error)
                                {{ $error }}
                                @endforeach
                            </p>
                        </div>
                        @endif
                        <!-- 02. Form input data -->
                        <form id="todo-form" action="{{ route('todo.post') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="task" id="todo-input"
                                    placeholder="Tambah produk baru" value="{{ old('task') }}" required>
                                <button class="btn btn-primary" type="submit">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <!-- 03. Searching -->
                        <form id="todo-form" action="{{ route('todo') }}" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search"
                                    value="{{ request('search') }}" placeholder="Masukkan kata kunci produk">
                                <button class="btn btn-secondary" type="submit">
                                    Cari
                                </button>
                            </div>
                        </form>

                        <ul class="list-group mb-4" id="todo-list">
                            @foreach ($data as $item)

                            <!-- 04. Display Data -->
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="task-text">
                                    {{ $item->task }}
                                </span>
                                <input type="text" class="form-control edit-input" style="display: none;"
                                    value="{{ $item->task }}">
                                <div class="btn-group">
                                    <form action="{{ route('todo.delete', ['id'=>$item->id]) }}" method="POST"
                                        onsubmit="return confirm('Apakah yakin menghapus data ini?')">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm delete-btn">✕</button>
                                    </form>
                                    <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="false">✎</button>
                                </div>
                            </li>
                            <!-- 05. Update Data -->
                            <li class="list-group-item collapse" id="collapse-{{ $loop->index }}">
                                <form action="{{ route('todo.update', ['id'=>$item->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="task"
                                                value="{{ $item->task }}">
                                            <button class="btn btn-outline-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                            @endforeach
                        </ul>
                        {{ $data->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS Bundle (popper.js included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>
