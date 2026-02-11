@extends('dashboard')

@section('halo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">Pendaftaran Talent</h2>
            <p class="text-muted mb-0">Kelola calon talent Jauki Tugas yang baru mendaftar.</p>
        </div>
    </div>
@endsection

@section('tabel')
    <div class="table-responsive">
        <table id="datatablesSimple" class="table table-hover border-0">
            <thead>
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>WA</th>
                    <th>Univ</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $talent)
                    <tr>
                        <td>{{ $talent->nama_lengkap }}</td>
                        <td>{{ $talent->email }}</td>
                        <td>{{ $talent->no_wa }}</td>
                        <td>{{ $talent->asal_univ }}</td>
                        <td>
                            @if($talent->status == 'pending')
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Pending</span>
                            @elseif($talent->status == 'verified')
                                <span class="badge bg-success px-3 py-2 rounded-pill">Verified</span>
                            @else
                                <span class="badge bg-danger px-3 py-2 rounded-pill">Rejected</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.talent.show', $talent->id) }}"
                                    class="btn btn-primary btn-sm rounded-3">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                <form action="{{ route('admin.talent.destroy', $talent->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-3 deleteButton">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection