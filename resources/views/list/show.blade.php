<!doctype html>
<html>
    <head>
    	<h1>Show all list</h1>
    </head>
    <body>
        <ul>
			@if(count($members))
				@foreach($members as $member)
					<li>
						<a href="/lists/{{$member['list_id'] }}/{{ $member['email_address']}}/edit">
							{{ $member['email_address'] }}
						</a>
					</li>
				@endforeach
			@endif
        </ul>
        <div>
			<a href="/lists/{{ $listId }}/create">Create New Member</a>
        </div>


    </body>
</html>