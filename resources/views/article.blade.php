@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Article') }}</div>

                <div class="card-body">
                    @if (is_object($content))
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{ $content->title }}</h3>
                                <div>{{ $content->created_at }} by {{ $content->name }}</div>
                                <div><img src="{{ url('/') }}/storage/{{ $content->image }}" style="height: 100px; float: left"> <strong>{{ $content->lead }}</strong></div>
                                <div>{{ $content->content }}</div>
                                <div><a href="{{ route('main') }}">Back to mainpage...</a></div>
                            </div>
                        </div>
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
