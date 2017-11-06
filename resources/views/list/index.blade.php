<!doctype html>
<html>
    <head>
        
    </head>
    <body>
        <ul>
        	@foreach($lists as $list)
            	<li>
            		<a href="/lists/{{$list['id']}}/members">
            			{{ $list['name'] }}
            		</a>	
            	</li>
            @endforeach	

        </ul>
    </body>
</html>