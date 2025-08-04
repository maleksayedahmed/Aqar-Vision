@extends('admin.layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6>Countries</h6>
                        <a href="{{ route('admin.countries.create') }}" class="btn btn-primary btn-sm">Create New Country</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Code</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($countries as $country)
                                <tr>
                                    <td><p class="text-xs font-weight-bold mb-0 px-3">{{ $country->name }}</p></td>
                                    <td><p class="text-xs font-weight-bold mb-0">{{ $country->code }}</p></td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="badge badge-sm {{ $country->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                                            {{ $country->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="d-flex justify-content-end gap-2">
                                            <a href="{{ route('admin.countries.edit', $country) }}" class="text-secondary font-weight-bold text-xs">Edit</a>
                                            <form action="{{ route('admin.countries.destroy', $country) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-danger font-weight-bold text-xs border-0 bg-transparent" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4">No countries found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection