@extends('admin.layouts.app')


@section('content')
    <form  class="form-horizontal" action="{{ route('prints.update', $print->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.prints.partials.form')
    </form>
@stop