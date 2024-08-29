@extends('layouts.app')

@section('content')
    @if (!have_posts())
        <div class="error-container">
            <h1>404</h1>
            <p class="error-text">{{ __('Sorry, but the page you were trying to view does not exist.', 'sage') }}</p>
        </div>
    @endif
@endsection
