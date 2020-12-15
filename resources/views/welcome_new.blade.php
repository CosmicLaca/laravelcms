@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Content') }}</div>

                <div class="card-body">
                    @if (is_object($content))
                        @foreach ($content AS $key => $article)
                            @if ($key % 3 == 0)
                                <div class="row">
                             @endif
                            <div class="col-md-4">
                                <h3>{{ $article->title }}</h3>
                                <div>{{ $article->created_at }} by {{ $article->name }}</div>
                                <div><img src="{{ url('storage') }}/{{ $article->image }}" style="height: 100px; float: left"> <strong>{{ $article->lead }}</strong></div>
                                <div><a href="{{ route('article') }}/{{ $article->uuid }}">Continue read...</a></div>
                            </div>
                            @if ($key % 3 == 2)
                                </div><hr>
                            @endif
                        @endforeach
                    @else
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                {{ $content }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
