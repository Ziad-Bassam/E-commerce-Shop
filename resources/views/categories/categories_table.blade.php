@extends('layouts.master')

@section('title')
    Products table
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="container mt-3 mb-3">
        <div>
            <a href="{{ route('add_category') }}" class="btn btn-primary mt-4 mb-4 w-25"><i
                    class="fa fa-plus">&nbsp;&nbsp;</i>Add
                category</a>
        </div>
        <table id="myTable" class="display nowrap">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Image Path</th>
                <th scope="col">Arabic Name</th>
                <th scope="col">Actoins</th>
            </tr>
        </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>{{ $category->image_path }}</td>
                    <td>{{ $category->name_AR }}</td>
                    <td>
                            <a href="{{ route('edit_category', ['catid' => $category->id]) }}" class="btn btn-success"><i
                                    class="fa fa-pen"></i>&nbsp;Edit category</a>
                            <a href="{{ route('delete_category', ['catid' => $category->id]) }}" class="btn btn-danger"><i
                                    class="fa fa-trash"></i>&nbsp;Delete
                            category</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-JobWAqYk5CSjWuVV3mxgS+MmccJqkrBaDhk8SKS1BW+71dJ9gzascwzW85UwGhxiSyR7Pxhu50k+Nl3+o5I49A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush



