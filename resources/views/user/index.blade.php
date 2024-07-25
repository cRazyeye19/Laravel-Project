@extends('layouts.content')
@section('main-content')
<div class="container">
    <h2>
        PHP CRUD with Image Upload (Laravel 11)
    </h2>
    <div class="text-end mb-5">
        <a href="{{route('user.create')}}" class="btn btn-primary">Add User</a>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="text-center">
                <th>#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th>Email Address</th>
                <th>Password</th>
                <th>Photo</th>
                <th>Action</th>
            </thead>
            <tbody>
                @forelse($users as $index => $row)
                <tr class="text-center">
                    <td>{{$index+1}}</td>
                    <td>{{$row->first_name}}</td>
                    <td>{{$row->last_name}}</td>
                    <td>{{$row->phone_number}}</td>
                    <td>{{$row->email}}</td>
                    <td>{{$row->masked_password}}</td>
                    <td>
                        <div class="showPhoto">
                            @php
                            $backgroundImage = !empty($row->photo)
                            ? url('uploads/' . $row->photo)
                            : url('/img/avatar.png');
                            @endphp
                            <div id="imagePreview" style="background-image: url('{{ $backgroundImage }}');">
                            </div>
                        </div>

                    </td>
                    <td>
                        <a href={{ route('user.edit', ['id' => $row->id]) }} class="btn btn-primary">Edit</a>
                        <button class="btn btn-danger" onclick="deleteFunction('{{ $row->id }}')">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">No Data</td">
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@include('user.delete')
@endsection

@push('js')
<script>
    function deleteFunction(id) {
        document.getElementById('delete_id').value = id;
        $("#modalDelete").modal('show');
    }
</script>
@endpush

<style>
    .showPhoto {
        width: 100%;
        height: 60px;
        margin: auto;
    }

    .showPhoto>div {
        width: 100%;
        height: 100%;
        border-radius: 30%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>