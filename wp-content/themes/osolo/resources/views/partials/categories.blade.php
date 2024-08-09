@php
  use App\View\Composers\App;
  global $post;
@endphp

<div class="c-category-filter">
  <div class="c-category-filter__wrapper">
    @foreach ($categories as $category)
      <a href="{{ App::getCategoryLink($category->taxonomy, $category->slug) }}" type="button"
        class="filter-links {{ !is_shop() && get_queried_object()->slug === $category->slug ? 'active' : '' }}">
        {{ $category->name }}</a>
    @endforeach
  </div>
  @include('partials.mobile-filter-categories')
</div>
