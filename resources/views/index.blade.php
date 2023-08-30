@extends('statamic::layout')
@section('title', 'Bunny Stream')

@section('content')
    <overview
        title="Videobrowser"
        api="{{ config('statamic.bunny.apiKey') }}"
        library="{{ config('statamic.bunny.libraryId') }}"
        hostname="{{ config('statamic.bunny.hostname') }}"
    ></overview>

    @include('statamic::partials.docs-callout', [
		'topic' => 'Videobrowser',
		'url' => 'https://statamic.com/addons/laborb/favicon-generator'
	])
@endsection
