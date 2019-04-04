<div class="form-group">
    <label for="">Наименование принта</label>
    <input class="form-control" type="text" name="title" placeholder="Наименование принта"
           value="{{ $print->title ?? "" }}" required>
</div>
<div class="form-group">
    <label for="">Товары</label>
    <select name="product_id[]" class="form-control" multiple>
        @isset($products)
            @forelse($products as $product_item)
                <option value="{{ $product_item->id }}"
                        @if (isset($products_active) && in_array($product_item->id, $products_active))
                        selected
                        @endif >
                    {{ $product_item->title }}
                </option>
            @empty
            @endforelse
        @endisset
    </select>
</div>
<div class="form-group">
    <label for="">Коллекции принтов</label>
    <select name="collection_print_id[]" class="form-control" multiple>
        @isset($collPrints)
            @forelse($collPrints as $collPrint_item)
                <option value="{{ $collPrint_item->id }}"
                        @if (isset($collPrints_active) && in_array($collPrint_item->id, $collPrints_active))
                        selected
                        @endif >
                    {{ $collPrint_item->title }}
                </option>
            @empty
            @endforelse
        @endisset
    </select>
</div>
<div class="form-group">
    <input type="submit" class="btn btn-success" value="Сохранить">
</div>
