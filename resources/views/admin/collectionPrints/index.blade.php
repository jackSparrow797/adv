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
                    <a href="{{ route('collections.create') }}" class="btn btn-primary">
                        Добавить Коллекцию принтов
                    </a>
                </div>
            </div>

            @forelse($collPrints as $item)
                {{--@dd($item->files)--}}
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('collections.edit', $item->id) }}">
                                    {!! $item->title !!}
                                </a>
                            </div>
                            <div class="col">
                                {!! $item->text !!}
                            </div>
                            <div class="col">
                                <form onsubmit="if(confirm('Удалить?')) { return true } else { return false }"
                                      action="{{ route('collections.destroy', $item->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Удалить">
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <p>Нет коллекций</p>
            @endforelse
        </div>
    </div>

    @if ($collPrints->total() > $collPrints->count())
        <div class="row">
            <div class="col-12">
                <div class="card my-3">
                    <div class="card-body">
                        {{ $collPrints->onEachSide(5)->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop