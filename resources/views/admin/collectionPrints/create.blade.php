@extends('admin.layouts.app')



@section('content')
    <form  class="form-horizontal" action="{{ route('collections.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('admin.collectionPrints.partials.form')
    </form>
@stop