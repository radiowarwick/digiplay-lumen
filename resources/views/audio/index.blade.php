@extends('layouts.app')

@section('title', 'Audio Library')

@section('breadcrumbs')
	{{ Breadcrumbs::render('audio-index') }}
@endsection

@section('content')
	<h1>Audio Library</h1>

	@include('forms.audio-search')

	<div class="row">
		<div class="col-md-4">
			<h3>Upload Audio</h3>
			@if(auth()->user()->hasPermission('Audio admin'))
				<div class="list-group">
					<a class="list-group-item" href="{{ route('audio-upload') }}">Upload Audio</a>
				</div>
			@else
				<p>
					Have some music that you want added to Digiplay? Send an email to <a href="mailto:music@radio.warwick.ac.uk">music@radio.warwick.ac.uk</a> with your music attached at least 48 hours before your show. Make sure the music is high quality! Be sure to include the following in the email:

					<ul>
						<li>Track Name</li>
						<li>Artist Name</li>
						<li>Album Name</li>
						<li>Does the track contain explicit content?</li>
					</ul>
				</p>
			@endif

			@if(auth()->user()->hasPermission('Playlist editor'))
				<h3>Playlists</h3>

				<p>
					View, edit and create playlists for the sustainer and the studio.
				</p>

				<div class="list-group">
					<a class="list-group-item" href="{{ route('playlist-index') }}">View/Create Playlists</a>
				</div>
			@endif
		</div>
		<div class="col-md-8">
			<h3>Newest Tracks</h3>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="icon"></th>
						<th>Title</th>
						<th>Artist</th>
						<th>Origin</th>
						<th>Upload</th>
					</tr>
				</thead>
				<tbody>
					@foreach($latest as $l)
						<tr>
							<td class="icon">
								<a href="{{ route('audio-view', $l->id) }}">
									<i class="fa fa-info-circle"></i>
								</a>
							</td>
							<td>{{ $l->title }}</td>
							<td>{{ $l->artist->name }}</td>
							<td>{{ $l->origin }}</td>
							<td>{{ date("d/m/Y H:i", $l->import_date) }}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection