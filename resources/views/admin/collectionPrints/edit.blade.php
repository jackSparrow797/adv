@extends('admin.layouts.app')


@section('content')
    <form  class="form-horizontal" action="{{ route('collections.update', $collPrints->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.collectionPrints.partials.form')
    </form>
@stop