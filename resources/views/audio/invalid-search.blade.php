@extends('layouts.app')

@section('title', 'Audio Search')

@section('content')
	@section('q', $q)

	@include('forms.audio-search')

	<h3>Search term needed or term is too short</h3>
	
@endsection