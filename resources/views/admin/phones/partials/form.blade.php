<div class="form-group">
    <label for="">Наименование модели телефона</label>
    <input class="form-control" type="text" name="title" placeholder="Наименование модели телефона" value="{{ $phone->title ?? "" }}" required>
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
    <input type="submit" class="btn btn-success" value="Сохранить">
</div>
