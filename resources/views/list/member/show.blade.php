@extends('layouts.master')

@section('title', 'Show all members for the list')

@section('content')
        <ul>
			@if(count($members))
				<table border="1">
				@foreach($members as $member)
					<tr>
						<td>
							<li>
								<a href="/lists/{{$member['list_id'] }}/{{ $member['email_address']}}/edit">
									{{ $member['email_address'] }}
								</a>
							</li>
						</td>
						<td>
							<a href="/lists/{{$member['list_id'] }}/{{ $member['email_address']}}/edit">edit</a>
						</td>
						<td>
							<a href="/lists/{{$member['list_id'] }}/{{ $member['email_address']}}/delete">delete</a>
						</td>

					</tr>

				@endforeach
				</table>

			@endif
        </ul>
        <div>
			<a href="/lists/{{ $listId }}/create">Create New Member</a>
        </div>
@stop