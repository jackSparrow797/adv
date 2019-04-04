@if ($errors->count() > 0)
    <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
    </div>
@endif
<div class="form-group">
    <label for="">Наименование</label>
    <input class="form-control" type="text" name="title" placeholder="Наименование" value="{{ $product->title ?? "" }}">
</div>
<div class="form-group">
    <label for="">Принт</label>
    <select name="print_model_id" class="form-control">
        @forelse($prints as $print_item)
            <option value="{{ $print_item->id }}" @if ($print_item->id == $product->print_model_id) selected @endif >
                {{ $print_item->title }}
            </option>
        @empty
            <option value="">Нет принтов</option>
        @endforelse
    </select>
</div>
<div class="form-group">
    <label for="">Модель телефона</label>
    <select name="phone_type_id" class="form-control">
        @forelse($phones as $phone_item)
            <option value="{{ $phone_item->id }}" @if ($phone_item->id == $product->phone_type_id) selected @endif >
                {{ $phone_item->title }}
            </option>
        @empty
            <option value="">Нет телефонов</option>
        @endforelse
    </select>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-success" value="Сохранить">
</div>
