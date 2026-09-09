@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Log Aktivitas</h2>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User</th>
                        <th>Aktivitas</th>
                        <th>Detail</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $index => $log)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $log->user }}</td>
                        <td>{{ $log->activity }}</td>
                        <td>{{ $log->details }}</td>
                        <td>{{ $log->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Belum ada aktivitas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection