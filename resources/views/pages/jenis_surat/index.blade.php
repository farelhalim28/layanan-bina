@extends('layouts.admin.app')

@section('title', 'Jenis Surat - Bina Desa')

@section('content')
<div class="page-heading d-flex justify-content-between align-items-center">
    <h3>Jenis Surat</h3>
    <a href="{{ route('admin.jenis-surat.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jenis Surat
    </a>
</div>

<section class="section mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Daftar Jenis Surat</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- FORM FILTER & SEARCH -->
            <div class="mb-3">
                <form method="GET" action="{{ route('admin.jenis-surat.index') }}">
                    <div class="row g-2">
                        <!-- FILTER BERDASARKAN PREFIX KODE -->
                        <div class="col-md-2">
                            <select name="filter_kode" class="form-select" onchange="this.form.submit()">
                                <option value="">Semua Jenis</option>
                                <option value="SKTM" {{ request('filter_kode') == 'SKTM' ? 'selected' : '' }}>SKTM</option>
                                <option value="SKU" {{ request('filter_kode') == 'SKU' ? 'selected' : '' }}>SKU</option>
                                <option value="SKCK" {{ request('filter_kode') == 'SKCK' ? 'selected' : '' }}>SKCK</option>
                                <option value="SKD" {{ request('filter_kode') == 'SKD' ? 'selected' : '' }}>SKD</option>
                                <option value="SKPWNI" {{ request('filter_kode') == 'SKPWNI' ? 'selected' : '' }}>SKPWNI</option>
                            </select>
                        </div>

                        <!-- SEARCH -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text"
                                       name="search"
                                       class="form-control"
                                       value="{{ request('search') }}"
                                       placeholder="Cari kode atau nama jenis surat...">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-search"></i> Cari
                                </button>
                            </div>
                        </div>

                        <!-- BUTTON RESET/CLEAR -->
                        <div class="col-md-2">
                            @if(request('search') || request('filter_kode'))
                                <a href="{{ route('admin.jenis-surat.index') }}"
                                   class="btn btn-outline-danger w-100">
                                    <i class="bi bi-x-circle"></i> Reset Filter
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- TABLE -->
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Kode</th>
                            <th width="30%">Nama Jenis</th>
                            <th width="35%">Syarat</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php use Illuminate\Support\Str; @endphp
                        @forelse($jenis_surat as $index => $jenis)
                        <tr>
                            <td>{{ ($jenis_surat->currentPage() - 1) * $jenis_surat->perPage() + $index + 1 }}</td>
                            <td><span class="badge bg-primary">{{ $jenis->kode }}</span></td>
                            <td>{{ $jenis->nama_jenis }}</td>
                            <td>
                                @if($jenis->syarat_json)
                                    <small class="text-muted">{{ Str::limit($jenis->syarat_json, 50) }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.jenis-surat.show', $jenis->jenis_id) }}"
                                   class="btn btn-sm btn-info" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.jenis-surat.edit', $jenis->jenis_id) }}"
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.jenis-surat.destroy', $jenis->jenis_id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus jenis surat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                @if(request('search'))
                                    <i class="bi bi-search"></i>
                                    Data tidak ditemukan dengan kata kunci "{{ request('search') }}"
                                @else
                                    <i class="bi bi-inbox"></i>
                                    Belum ada jenis surat
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="mt-3">
                {{ $jenis_surat->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</section>
@endsection
