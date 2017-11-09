@extends('layouts.master')

@section('title', 'Show all list')

@section('content')
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

@stop

