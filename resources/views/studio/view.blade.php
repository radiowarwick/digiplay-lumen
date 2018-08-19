<!DOCTYPE html>
<html lang="en">
	<head>
		<title>RAW Digiplay - Studio {{ $location }}</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<meta charset="utf-8">

		<link rel="stylesheet" type="text/css" href="/css/app.css">
		
		<script src="/js/app.js"></script>
		<script src="/js/studio/main.js"></script>
	</head>
	<body class="studio-body" style>
		<script type="text/javascript">
			const CENSOR_START = {{ $censor_start }};
			const CENSOR_END = {{ $censor_end }};
		</script>

		<div class="container-fluid studio-now-next border-bottom border-warning border-3">
			<div class="row">
				<div class="col-sm-6">On now: RAW Jukebox</div>
				<div class="col-sm-6">On next: RAW Jukebox</div>
			</div>
		</div>

		<div class="container-fluid studio-container">
			<div class="row no-gutters studio-container-row">
				<div class="col-sm-7 border-right border-warning border-3 studio-col-left">
					<ul class="nav nav-tabs nav-justified studio-tabs">
						<li class="nav-item">
							<a class="nav-link active studio-tab" data-toggle="tab" href="#music" role="tab">
								<i class="fa fa-music"></i>
								Music
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link studio-tab" data-toggle="tab" href="#messages" role="tab">
								<i class="fa fa-envelope"></i>
								Messages
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link studio-tab" data-toggle="tab" href="#playlists" role="tab">
								<i class="fa fa-th-list"></i>
								Playlists
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link studio-tab" data-toggle="tab" href="#log" role="tab">
								<i class="fa fa-pencil"></i>
								Log
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link studio-tab bg-danger studio-reset">
								Reset
							</a>
						</li>
					</ul>
					<div class="tab-content studio-tab-content">
						<div class="tab-pane show active" id="music" role="tabpanel">
							<div class="studio-song-search border-warning border-bottom">
								<div class="input-group">
									<input class="form-control" type="text" name="query" placeholder="Search...">
									<span class="input-group-btn">
										<button type="submit" class="btn btn-search btn-warning">
											Search
										</button>
									</span>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="studio-check-title" checked>
									<label class="form-check-label" for="studio-check-title">Title</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="studio-check-artist" checked>
									<label class="form-check-label" for="studio-check-artist">Artist</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="checkbox" id="studio-check-album" checked>
									<label class="form-check-label" for="studio-check-album">Album</label>
								</div>
							</div>
							<div class="studio-song-search-results">
								<div class="studio-song-search-welcome">
									<h1>Welcome to Digiplay, {{ auth()->user()->name }}!</h1>
									<h2>Search for a song or load songs from playlists</h2>
								</div>
								<div class="studio-song-search-none" style="display:none;">
									<h2>No results found, please refine your search.</h2>
								</div>
								<div class="studio-song-search-table" style="display:none;">
									<table class="table table-hover">
										<thead>
											<tr>
												<th class="icon"></th>
												<th class="artist">Artist</th>
												<th class="title">Title</th>
												<th class="album">Album</th>
												<th class="length">Length</th>
											</tr>
										</thead>
										<tbody class="studio-song-search-table-results">
										</tbody>
									</table>
								</div>
								<div class="studio-song-search-loading text-center" style="display:none;">
									<h1>Searching...</h1>
									<h1><i class="fa fa-spinner fa-pulse"></i></h1>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="messages" role="tabpanel">
							<div class="container-fluid studio-message-list border-bottom border-warning">
								<table class="table table-hover">
									<thead>
										<tr>
											<th class="icon"></th>
											<th class="sender">Sender</th>
											<th class="subject">Subject</th>
											<th class="date">Date/Time</th>
										</tr>
									</thead>
									<tbody>
										@foreach($emails as $email)
											<tr data-message-id="{{ $email->id }}">
												<td class="icon">
													@if($email->new_flag == 't')
														<i class="fa fa-envelope"></i>
													@endif											
												</td>
												<td class="sender text-truncate">
													{{ preg_replace('/<.*>/', '', $email->sender) }}
												</td>
												<td class="subject text-truncate">
													{{ $email->subject }}
												</td>
												<td class="date text-truncate">
													{{ date('d/m/y H:i', $email->datetime) }}
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<div class="container-fluid studio-message-container">
								<h3 class="text-truncate" id="studio-message-subject"></h3>
								<p id="studio-message-body">
								</p>
							</div>
						</div>
						<div class="tab-pane" id="log" role="tabplanel">
							<div class="container-fluid studio-log-add border-bottom border-warning">
								<div class="form-inline studio-log-form">
									<input type="text" class="form-control mr-sm-2 studio-log-artist" name="artist" class="studio-log-artist" placeholder="Artist">
									<input type="text" class="form-control mr-sm-2 studio-log-title" name="title" class="studio-log-title" placeholder="Title">
									<button type="button" class="btn btn-warning" name="submit-log">Log</button>
								</div>
							</div>
							<div class="container-fluid studio-log-table">
								<table class="table table-hover">
									<thead>
										<tr>
											<th class="artist">Artist</th>
											<th class="title">Title</th>
											<th class="date">Date/Time</th>
										</tr>
									</thead>
									<tbody>
										@foreach($log as $log_entry)
											<tr>
												<td class="artist">{{ $log_entry->track_artist }}</td>
												<td class="title">{{ $log_entry->track_title }}</td>
												<td class="date">{{ date('d/m/y H:i', $log_entry->datetime) }}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5 studio-col-right">
					<div class="studio-showplan-header">
						<h3>Plan - Default</h3>
					</div>
					<div class="studio-showplan">
						@foreach($showplan->items as $item)
							<div class="studio-card card" data-item-id="{{ $item->id }}">
								<div class="card-body">
									@if($item->audio->censor == 't')
										<i class="censor fa fa-exclamation-circle"></i>
									@else
										<i class="fa fa-music"></i>
									@endif
									{{ $item->audio->title }} - {{ $item->audio->artist->name }}
									<div class="pull-right">
										{{ $item->audio->lengthString() }}
										<span class="studio-card-remove">
											<i class="fa fa-times-circle fa-lg"></i>
										</span>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<footer class="footer studio-footer bg-dark text-warning border-top border-warning border-3">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-3">
						<div class="logo-sm">
							@include('layouts.logo')
						</div>
					</div>
					<div class="col-sm-7"></div>
					<div class="col-sm-2">
						<a href="{{ route('studio-logout', $key) }}" class="btn btn-lg btn-block btn-warning pull-right">Log Out</a>
					</div>
				</div>
			</div>
		</footer>
	</body>
</html>