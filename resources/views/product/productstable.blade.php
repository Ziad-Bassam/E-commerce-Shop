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
            <a href="{{ route('add_product') }}" class="btn btn-primary mt-4 mb-4 w-25"><i
                    class="fa fa-plus">&nbsp;&nbsp;</i>Add
                product</a>
        </div>
        <table id="myTable" class="display nowrap">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td><img src="{{ $product->image_path }}" width="100" height="100" alt=""></td>
                        <td>
                            <a href="{{ route('edit_product', ['productid' => $product->id]) }}" class="btn btn-success"><i
                                    class="fa fa-pen"></i>&nbsp;Edit product</a>
                            <a href="{{ route('add_product_images', ['productid' => $product->id]) }}"
                                class="btn btn-dark"><i class="fa fa-image"></i>&nbsp;Add photos of product</a>
                            <a href="{{ route('delete_product', ['productid' => $product->id]) }}" class="btn btn-danger"><i
                                    class="fa fa-trash"></i>&nbsp;Delete product</a>
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
