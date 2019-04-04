@extends('admin.layouts.app')



@section('content')
    <form  class="form-horizontal" action="{{ route('phones.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('admin.phones.partials.form')
    </form>
@stop