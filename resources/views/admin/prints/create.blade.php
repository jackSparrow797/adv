@extends('admin.layouts.app')



@section('content')
    <form  class="form-horizontal" action="{{ route('prints.store') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        @include('admin.prints.partials.form')
    </form>
@stop