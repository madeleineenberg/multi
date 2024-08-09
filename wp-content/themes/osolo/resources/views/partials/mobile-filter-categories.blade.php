@php
    use App\View\Composers\App;
@endphp

<div class="c-category-filter__toggle-btn">
    <button class="theme-btn" id="filter-toggler"><?= __('Filtrera', 'osolo') ?></button>
</div>

<div class="c-category-filter__wrapper--mobile">
    <div class="filter-heading">
        <h6><?= __('Filtrera', 'osolo') ?></h6>
        <span class="close-btn" id="close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                <g fill="none" fill-rule="evenodd" stroke-linecap="square">
                    <line x1="1.5" x2="13.5" y1="13.5" y2="1.5" stroke="#979797"
                        stroke-width="1.5" />
                    <line x1="1.5" x2="13.5" y1="13.5" y2="1.5" stroke="#979797"
                        stroke-width="1.5" transform="matrix(-1 0 0 1 15 0)" />
                </g>
            </svg>
        </span>
    </div>

    <div class="c-category-filter__buttons">
        @foreach ($categories as $category)
            <a href="{{ App::getCategoryLink($category->taxonomy, $category->slug) }}" type="button"
                class="theme-btn {{ !is_shop() && get_queried_object()->slug === $category->slug ? 'active' : '' }}">
                {{ $category->name }}</a>
        @endforeach
    </div>
</div>
