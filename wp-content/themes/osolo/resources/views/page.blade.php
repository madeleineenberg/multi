@php
  $wc_conditional = true;

  if (class_exists('Woocommerce')) {
      $wc_conditional = !is_cart() && !is_checkout() && !is_account_page();
  }
@endphp

@extends('layouts.app')

@section('content')
  @while (have_posts())
    @php(the_post())

    <div class="content-wrapper">
      @include('partials.page-header')
      @includeFirst(['partials.content-page', 'partials.content'])
    </div>
  @endwhile

  @if (!is_front_page() && $wc_conditional)
    @include('partials.social-box')
  @endif
@endsection
