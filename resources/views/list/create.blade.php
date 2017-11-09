@extends('layouts.master')

@section('title', 'Create List')

@section('content')
    <div>
        <form name= "create_list" action="/lists/store/" method="POST">
            {{ csrf_field() }}
            <table>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>
                        <label for="listname">List Name:</label>
                    </td>
                    <td>
                        <input type="text" id="listname" name="listname" required />
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>
                        <input type="submit" id="submit" name="submit" value="Submit" />
                    </td>
                    <td>
                    </td>
                </tr>
            </table>
        </form>
    </div>
@stop