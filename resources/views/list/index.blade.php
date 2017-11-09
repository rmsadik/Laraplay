@extends('layouts.master')

@section('title', 'Show all list')

@section('content')
		@if($noAPI || $invalidApiKey)
            @if($invalidApiKey)
                <div>
                    <h3>Invalid API key, please provide valid key.</h3>
                </div>
            @endif
            <div>
                <form method="POST" action="/lists/index">
                    {{ csrf_field() }}
                    <label>Enter API Key</label>
                    <input type="text" id="apiKey" name="apiKey" style="width:300px;" />
                    <input type="submit" value="Submit">
                </form>
            </div>

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
                        <td><a href="/lists/{{ $list['id'] }}/create">Create Member</td>

                    </tr>
					@endforeach
				</table>


			</ul>
		@endif

@stop

