<!doctype html>
<html>
    <head>
        
    </head>
    <body>
        <form action="/my-handling-form-page" method="post"> 
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
                        <label for="mail">E-mail:</label>
                    </td>
                    <td>
                        <input type="email" id="mail" name="user_email" value=" {{$member['email_address'] }}" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="button" id="submit" name="submit" value="Submit" />
                    </td>
                    <td>
                        <input type="button" id="submit" name="cancel" value="Cancel" />
                    </td>
                </tr>
            </table>    
        </form>  
    </body>
</html>