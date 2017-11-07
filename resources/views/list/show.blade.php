<!doctype html>
<html>
    <head>
    	<h1>Show all list</h1>
    </head>
    <body>
        <ul>
        	@foreach($members as $member)
            	<li>
            		<a href="/lists/{{$member['list_id'] }}/{{$member['email_address']}}/edit">
            			{{ $member['email_address'] }}
            		</a>	
            	</li>
            @endforeach	

        </ul>
        <div>
        	<a href="/lists/{{$member['list_id'] }}/create">Create New Member</a>
        </div>


    </body>
</html>