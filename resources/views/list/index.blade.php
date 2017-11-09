@extends('layouts.master')

@section('title', 'Show all list')

@section('content')
		@if($noAPI || $invalidApiKey)
            @if($invalidApiKey)
                <h3>Invalid API key, please provide valid key.
            @endif
			<form method="POST" action="/lists/index">
                {{ csrf_field() }}
                <label>Enter access token</label>
				<input type="text" id="apiKey" name="apiKey"/>
                <input type="submit" value="Submit">
			</form>

		@else
			<ul>
				<table border="1">
					@foreach($lists as $list)
					<tr>
						<td>
						<li>
							<a href="/lists/{{ $list['id'] }}/members">
								{{ $list['name'] }}
							</a>
						</li>
						</td>
						<td><a href="/lists/{{ $list['id'] }}/edit">Edit</td>
						<td><a href="/lists/{{ $list['id'] }}/delete">Delete</td>

					</tr>
					@endforeach
				</table>


			</ul>
		@endif

@stop

