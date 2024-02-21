@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($message = Session::get('update'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($message = Session::get('delete'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#tambah"
                            class="btn btn-primary btn-sm">Tambah
                            Data Siswa</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NISN | NIS</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No HP</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($siswa as $no => $s)
                                    <tr>
                                        <th scope="row">{{ ++$no }}</th>
                                        <td>{{ $s->nisn }} | {{ $s->nis }}</td>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->kelas->nama_kelas }}</td>
                                        <td>{{ $s->alamat }}</td>
                                        <td>{{ $s->no_hp }}</td>
                                        <td>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#edit{{ $s->id }}"
                                                class="btn btn-secondary btn-sm">Edit</a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#tampil{{ $s->id }}"
                                                class="btn btn-warning btn-sm">Lihat</a>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $s->id }}"
                                                class="btn btn-danger btn-sm">Hapus</a>
                                        </td>
                                    @empty
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="bi bi-exclamation-triangle-fill flex-shrink-0 me-2"
                                                viewBox="0 0 16 16" role="img" aria-label="Warning:"
                                                style="width: 20px;">
                                                <path
                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                            <div>
                                                Data Kelas Belum Ada !
                                            </div>
                                        </div>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $siswa->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('modal')
    {{-- Modal Tambah --}}
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text"
                                class="form-control @error('nama')
                            is-invalid
                            @enderror"
                                name="nama" placeholder="Masukkan nama dengan Benar">

                            @error('nama')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NISN</label>
                            <input type="number"
                                class="form-control @error('nisn')
                            is-invalid
                            @enderror"
                                name="nisn" placeholder="Masukkan nisn dengan Benar">

                            @error('nisn')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="number"
                                class="form-control @error('nis')
                            is-invalid
                            @enderror"
                                name="nis" placeholder="Masukkan nis dengan Benar">

                            @error('nis')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select class="form-select @error('kelas_id') is-invalid @enderror"
                                name="kelas_id" aria-label="Masukkan nis dengan Benar">
                                <option selected>Open this select menu</option>
                                @foreach ($kelas as $k)
                                    <option value="{{$k->id}}">{{$k->nama_kelas}}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea
                                class="form-control @error('alamat')
                            is-invalid
                            @enderror"
                                name="alamat" rows="3"></textarea>

                            @error('alamat')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="number"
                                class="form-control @error('no_hp')
                            is-invalid
                            @enderror"
                                name="no_hp" placeholder="Masukkan no_hp dengan Benar">

                            @error('no_hp')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SPP</label>
                            <select class="form-select @error('spp_id') is-invalid @enderror"
                                name="spp_id" aria-label="Masukkan nis dengan Benar">
                                <option selected>Open this select menu</option>
                                @foreach ($spp as $p)
                                    <option value="{{$p->id}}">{{$p->tahun}}</option>
                                @endforeach
                            </select>
                            @error('spp_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-- Modal Edit --}}
    @foreach ($siswa as $s)
    <div class="modal fade" id="edit{{$s->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('siswa.update',$s->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text"
                                class="form-control @error('nama')
                            is-invalid
                            @enderror"
                                name="nama" value="{{old('nama', $s->nama)}}" placeholder="Masukkan nama dengan Benar">

                            @error('nama')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NISN</label>
                            <input type="number"
                                class="form-control @error('nisn')
                            is-invalid
                            @enderror"
                                name="nisn" value="{{old('nisn', $s->nisn)}}" placeholder="Masukkan nisn dengan Benar" disabled>

                            @error('nisn')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIS</label>
                            <input type="number"
                                class="form-control @error('nis')
                            is-invalid
                            @enderror"
                                name="nis" value="{{old('nis', $s->nis)}}" placeholder="Masukkan nis dengan Benar" disabled>

                            @error('nis')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select class="form-select @error('kelas_id') is-invalid @enderror"
                                name="kelas_id" aria-label="Masukkan nis dengan Benar">
                                <option selected>{{$s->kelas_id}}</option>
                                @foreach ($kelas as $k)
                                    <option value="{{$k->id}}">{{$k->nama_kelas}}</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea
                                class="form-control @error('alamat')
                            is-invalid
                            @enderror"
                                name="alamat" rows="3">{{$s->alamat}}</textarea>

                            @error('alamat')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No HP</label>
                            <input type="number"
                                class="form-control @error('no_hp')
                            is-invalid
                            @enderror"
                                name="no_hp" value="{{old('no_hp', $s->no_hp)}}" placeholder="Masukkan no_hp dengan Benar">

                            @error('no_hp')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SPP</label>
                            <select class="form-select @error('spp_id') is-invalid @enderror"
                                name="spp_id" aria-label="Masukkan nis dengan Benar">
                                <option selected>{{$s->spp_id}}</option>
                                @foreach ($spp as $p)
                                    <option value="{{$p->id}}">{{$p->tahun}}</option>
                                @endforeach
                            </select>
                            @error('spp_id')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    {{-- Modal Tampil --}}
    @foreach ($siswa as $s)
    <div class="modal fade" id="tampil{{$s->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Data Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <p class="text-center"><b>{{$s->nama}}</b></p>
                   <p><b>NISN | NIS:</b> {{$s->nisn}} | {{$s->nis}}</p>
                   <p><b>Kelas:</b> {{$s->kelas->nama_kelas}}</p>
                   <p><b>Alamat:</b> {{$s->alamat}}</p>
                   <p><b>No. HP:</b> {{$s->no_hp}}</p>
                   <p><b>Tahun SPP:</b> {{$s->spp->tahun}}</p>
                   <p><b>Nominal SPP:</b> <span class="btn btn-success">{{'Rp. ' . number_format($s->spp->nominal, 2, '.', '.')}}</span></p>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    {{-- Modal Delete --}}
    @foreach ($siswa as $s)
        <div class="modal fade" id="delete{{ $s->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Siswa</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin ingin mengahpus data <b>{{ $s->nama }}</b>?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <form action="{{ route('siswa.destroy', $s->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-success">Ya, Hapus</button>
                        </form>
                    </div>
                    </form>
                </div>

            </div>
        </div>
        </div>
    @endforeach
@endpush
