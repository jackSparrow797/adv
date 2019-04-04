@extends('admin.layouts.app')


@section('content')
    <form  class="form-horizontal" action="{{ route('phones.update', $phone->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.phones.partials.form')
    </form>
@stop