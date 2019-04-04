@extends('admin.layouts.app')



@section('content')
    <form  class="form-horizontal" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('admin.product.partials.form')
    </form>
@stop