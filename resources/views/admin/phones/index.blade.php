@extends('admin.layouts.app')

{{--@section('title', 'Новости')--}}

{{--@section('content_header')--}}
    {{--<h1>Новости</h1>--}}
{{--@stop--}}

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row mb-3">
                <div class="col-12">
                    <a href="{{ route('phones.create') }}" class="btn btn-primary">
                        Добавить Модель телефона
                    </a>
                </div>
            </div>

            @forelse($phones as $item)
                {{--@dd($item->files)--}}
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('phones.edit', $item->id) }}">
                                    {!! $item->title !!}
                                </a>
                            </div>
                            <div class="col">
                                {!! $item->text !!}
                            </div>
                            <div class="col">
                                <form onsubmit="if(confirm('Удалить?')) { return true } else { return false }"
                                      action="{{ route('phones.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Удалить">
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <p>Нет телефонов</p>
            @endforelse
        </div>
    </div>
@stop