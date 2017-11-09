@extends('layouts.master')

@section('title', 'Create member')

@section('content')
        <form name= "create_member" action="/lists/{{$listId}}/store/" method="POST"> 
            {{ csrf_field() }}
            <table>
                <tr>
                    <td>
                        <label for="fname">First Name:</label>
                    </td>
                    <td>
                        <input type="text" id="fname" name="fname" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="lname">Last Name:</label>
                    </td>
                    <td>
                        <input type="text" id="lname" name="lname" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">E-mail:</label>
                    </td>
                    <td>
                        <input type="email" id="email" name="email" required />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" id="listId" name="listId" value="{{ $listId }}" />
                        <input type="submit" id="submit" name="submit" value="Submit" />
                    </td>
                    <td>
                    </td>
                </tr>
            </table>    
        </form>
@stop