<div class="filters">
    <form method="GET" action="{{ route('products.index') }}" class="filters-form">
        <div class="filter-group">
            <label for="q">Поиск по названию:</label>
            <input type="text" name="q" id="q" value="{{ request('q') }}">
        </div>

        <div class="filter-group">
            <label for="price_from">Цена от:</label>
            <input type="number" name="price_from" id="price_from" value="{{ request('price_from') }}" min="0">
        </div>

        <div class="filter-group">
            <label for="price_to">Цена до:</label>
            <input type="number" name="price_to" id="price_to" value="{{ request('price_to') }}" min="0">
        </div>

        <div class="filter-group">
            <label for="category_id">Категория:</label>
            <select name="category_id" id="category_id">
                <option value="">Все категории</option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter-group">
            <label for="in_stock">Только в наличии:</label>
            <input
                type="checkbox"
                name="in_stock"
                id="in_stock"
                value="1"
                {{ request('in_stock') ? 'checked' : '' }}
            >
        </div>

        <div class="filter-group">
            <label for="rating_from">Рейтинг от:</label>
            <select name="rating_from" id="rating_from">
                <option value="">Любой</option>
                @for ($i = 5; $i >= 1; $i--)
                    <option
                        value="{{ $i }}"
                        {{ request('rating_from') == $i ? 'selected' : '' }}
                    >
                        {{ $i }} и выше
                    </option>
                @endfor
            </select>
        </div>

        <div class="filter-group">
            <label for="sort">Сортировка:</label>
            <select name="sort" id="sort">
                <option value="" {{ request('sort') == '' ? 'selected' : '' }}>
                    По названию
                </option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                    По цене: по возрастанию
                </option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                    По цене: по убыванию
                </option>
                <option value="rating_desc" {{ request('sort') == 'rating_desc' ? 'selected' : '' }}>
                    По рейтингу
                </option>
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>
                    По новизне
                </option>
            </select>
        </div>

        <div class="filter-actions">
            <button type="submit">Применить</button>
            <a href="{{ route('products.index') }}" class="reset-btn">Сбросить</a>
        </div>
    </form>
</div>
