<html>
    <head>
        <title>Login Page</title>
    </head>
    <body bgcolor='lightblue' align="center">
        <h1>Welcome Back!</h1>
        <form method='POST' action='verify.php'>
            <table align="center" width="400" cellpadding="10" cellspacing="0" border="0" bgcolor="#f0f8ff">
                <tr>
                    <td colspan="2" align="center">
                        <h2>Login Here</h2>
                    </td>
                </tr>
                <tr>
                    <td align="right">Username (Email):</td>
                    <td>
                        <input type='text' name='username' required>
                    </td>
                </tr>
                <tr>
                    <td align="right">Password:</td>
                    <td>
                        <input type='password' name='password' required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <br>
                        <input type='submit' value='Login' name='submit'>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>