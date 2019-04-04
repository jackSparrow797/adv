<div class="form-group">
    <label for="">Наименование коллекции принтов</label>
    <input class="form-control" type="text" name="title" placeholder="Наименование коллекции принтов" value="{{ $collPrints->title ?? "" }}" required>
</div>
<div class="form-group">
    <label for="">Принты</label>
    <select name="print_id[]" class="form-control" multiple>


        @isset($prints)
            @forelse($prints as $print_item)
                <option value="{{ $print_item->id }}"
                        @if (isset($collPrints_active) && in_array($print_item->id, $collPrints_active))
                        selected
                        @endif >
                    {{ $print_item->title }}
                </option>
            @empty
            @endforelse
        @endisset
    </select>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-success" value="Сохранить">
</div>
