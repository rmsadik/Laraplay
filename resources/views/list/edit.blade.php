@extends('layouts.master')

@section('title', 'Edit List')

@section('content')
        <form name= "edit_member" action="/lists/{{ $list['id'] }}/update" method="POST">
            {{ csrf_field() }}
            <table>
                <tr>
                    <td>
                        <label for="listname">List Name:</label>
                    </td>
                    <td>
                        <input type="text" id="listname" name="listname" value="{{$list['name']}}"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" id="listId" name="listId" value="{{ $list['id'] }}"/>
                        <input type="submit" id="submit" name="submit" value="Submit" />
                    </td>
                    <td>
                    </td>
                </tr>
            </table>    
        </form>  
@stop