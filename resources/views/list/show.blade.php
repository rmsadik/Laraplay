<!doctype html>
<html>
    <head>
        
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
    </body>
</html>