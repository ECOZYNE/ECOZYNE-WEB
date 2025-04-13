<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Students | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/all.min.css">
</head>
<body>
<div class="container">
    <div class="card mt-4">
        <div class="card-header">Data Siswa
            <a href="/student/add" type="button" style="float:right" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-2"></i>Tambah</a>
        </div>
        <div class="card-body">
            @if (session('alert') && session('type') == 1)
                <div class="alert alert-success">
                    {{ session('alert') }}
                </div>
            @elseif (session('alert') && session('type') != 1)
                <div class="alert alert-danger">
                    {{ session('alert') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Prodi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->nim }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->prodi }}</td>
                                <td>
                                    <a href="/student/edit/{{ $data->nim }}" class="btn btn-sm btn-warning me-1">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form method="POST" action="/student/delete/{{ $data->nim }}" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger me-1">
                                            <i class="fas fa-trash-alt me-1"></i>Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%">Tidak ada data untuk ditampilkan !</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
