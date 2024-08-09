@extends('layouts.app')

@section('content')
  @if (!have_posts())
    <div class="container">
      <div class="row c-404">
        <div class="c-404__title has-primary-background-color">
          <h1>
            @if ($topText)
              {{ $topText }}<br />
            @endif
            @if ($pageTitle)
              {{ $pageTitle }}
            @endif
          </h1>
        </div>
        @if ($textArea)
          <div class="c-404__text">
            {!! $textArea !!}
          </div>
        @endif
      </div>
    </div>
  @endif
@endsection
