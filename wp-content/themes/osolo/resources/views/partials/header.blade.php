<header class="c-header sticky-top {{ $backgroundColor ? 'white' : 'transparent' }}">
  @if (!$hide_search)
    <div class="search-box">
      @include('partials.header-search')
    </div>
  @endif
  <div class="container">
    <a class="brand" href="{{ home_url('/') }}">
      @if ($logo)
        <div class="company-logo-wrapper">
          <img class="svg company-logo" src="{{ $logo['sizes']['large'] }}" alt="{{ __('Company logo', 'osolo') }}">
        </div>
      @endif
    </a>
    <div id="hamburger">
      @svg('images.icon_hamburger')
    </div>

    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu([
            'theme_location' => 'primary_navigation',
            'menu_class' => 'nav',
            'echo' => false,
            'walker' => new Add_button_of_Sublevel_Walker(),
        ]) !!}
      @endif
    </nav>

    @if (!$hide_search)
      <div class="nav-search">
        <span>Sök</span>
        @svg('images.icon_search')
      </div>
    @endif

    <nav class="nav-right">
      @if (has_nav_menu('right_navigation'))
        {!! wp_nav_menu(['theme_location' => 'right_navigation', 'menu_class' => 'second-nav', 'echo' => false]) !!}
      @endif
    </nav>

    @if (!$hide_cart_btn && function_exists('wc_get_cart_url'))
      <div class="cart-btn">
        <a href="{{ wc_get_cart_url() }}">
          @svg('images.cart')
          <div class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
        </a>
      </div>
    @endif
  </div>
</header>
<div class="overlay-menu"></div>

@if (function_exists('is_shop') && is_shop())
  @if ($heroImage && !is_search())
    <div class="c-pageHero">
      {!! wp_get_attachment_image($heroImage, '2048x2048') !!}
    </div>
  @endif
@endif

@if (function_exists('yoast_breadcrumb') && !is_front_page())
  <div class="container">
    <div class="row">
      <div class="c-breadcrumbs">
        <?php yoast_breadcrumb(); ?>
      </div>
    </div>
  </div>
@endif
