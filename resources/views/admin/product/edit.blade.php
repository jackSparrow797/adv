@extends('admin.layouts.app')


@section('content')
    <form  class="form-horizontal" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.product.partials.form')
    </form>
@stop