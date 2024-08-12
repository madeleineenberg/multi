@include('partials.header')

@php
global $post;
$post_slug = $post->post_name;
@endphp

<div class="main-container" data-scroll-container>
    <main class="main {{ $post_slug }}">
        @yield('content')

    </main>
</div>
@include('partials.footer')
