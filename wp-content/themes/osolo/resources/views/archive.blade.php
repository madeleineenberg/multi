@extends('layouts.app')

@section('content')
  @if (!have_posts())
    {!! get_search_form(false) !!}
  @endif

  @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])

  {!! get_the_posts_navigation() !!}
@endsection
