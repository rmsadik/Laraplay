@extends('layouts.master')

@section('title', 'Show all list')

@section('content')
        <ul>
            @foreach($lists as $list)
                <li>
                    <a href="/lists/{{$list['id']}}/members">
                        {{ $list['name'] }}
                    </a>    
                </li>
            @endforeach 

        </ul>

@stop

