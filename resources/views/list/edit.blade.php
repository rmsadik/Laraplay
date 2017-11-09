@extends('layouts.master')

@section('title', 'Edit List')

@section('content')
        <form name= "edit_member" action="/lists/{{ $member['list_id'] }}/{{ $member['email_address']}}/update" method="POST"> 
            {{ csrf_field() }}
            <table>
                <tr>
                    <td>
                        <label for="fname">First Name:</label>
                    </td>
                    <td>
                        <input type="text" id="fname" name="fname" value="{{$member['merge_fields']['FNAME']}}"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="lname">Last Name:</label>
                    </td>
                    <td>
                        <input type="text" id="lname" name="lname" value="{{$member['merge_fields']['LNAME']}}" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">E-mail:</label>
                    </td>
                    <td>
                        <input type="email" id="email" name="email" value=" {{$member['email_address'] }}" readonly />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" id="submit" name="submit" value="Submit" />
                    </td>
                    <td>
                    </td>
                </tr>
            </table>    
        </form>  
@stop