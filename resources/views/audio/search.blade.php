@extends('layouts.app')

@section('title', 'Audio Search')

@section('breadcrumbs')
	{{ Breadcrumbs::render('audio-search') }}
@endsection

@section('content')
	@section('q', $q)

	@include('forms.audio-search')

	<h3>You got {{ $total }} results</h3>
  
  @if($total>0)
    <table class="table table-striped" cellspacing="0">
      <thead>
	  		<th class="title">Title</th>
	  		<th class="artist">Artist</th>
	  		<th class="album">Album</th>
	  		<th class="length">Length</th>
        @foreach($results as $result)
          <tr>
            <td class="title"> {{ $result->title }} </td>
            <td class="artist"> {{ $result->artist->name }} </td>
            <td class="album"> {{ $result->album->name }} </td>
            <td class="length">  {{ $result->lengthString() }} </td>
           </td>
          </tr>
        @endforeach
      </thead>
    </table>
  @endif

	{{ $results->appends(['q' => $q])->links() }}
@endsection
