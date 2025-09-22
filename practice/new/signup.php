<html>
    <head>
        <title>Login Form</title>
    </head>
    <body bgcolor='green' align="center">
        <h1>Join Social Network</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <table align="center" width="400" cellpadding="10" cellspacing="0" border="0" bgcolor="#f0f8ff">
                <tr>
                    <td colspan="2" align="center">
                        <h2>Sign Up Here</h2>
                    </td>
                </tr>
                <tr>
                    <td align="right">Full Name:</td>
                    <td><input type='text' name='name' required></td>
                </tr>
                <tr>
                    <td align="right">Date of Birth:</td>
                    <td><input type='date' name='dob' required></td>
                </tr>
                <tr>
                    <td align="right">Email Address:</td>
                    <td><input type='email' name='email' required></td>
                </tr>
                <tr>
                    <td align="right">Password:</td>
                    <td>
                        <input type='password' name='password' required>
                        <br><small style="font-size: 10px; color: gray;">Use A-Z, a-z, 0-9, !@#$%^&* in password</small>
                    </td>
                </tr>
                <tr>
                    <td align="right">Enter Again Password:</td>
                    <td><input type='password' name='repassword' required></td>
                </tr>
                <tr>
                    <td align="right">Upload Profile Photo:</td>
                    <td><input type="file" name="photo" accept=".jpg,.jpeg,.png,.gif"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <br>
                        <input type="submit" name="submit" value="SignUp">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php
        if(isset($_POST['submit'])){
            $c = $_POST['email'];
            $adc = mysqli_connect("localhost","root","","webkool");
            $sql = "select * from mypage where email ='$c'";
            $record = $adc->query($sql);
            $n = mysqli_num_rows($record);
            if($n!=0){
                echo "<font color =red size =5> Email ID Already Exit </font>"; 
                echo "<br>";
                echo "<font color =red size =5> Enter details Again </font>"; 
            }else{
                $a = $_POST['password'];
                $b= $_POST['repassword'];
                if(strcmp($a,$b)!==0){
                    echo "<font color =red size =5> Password doesn't match </font>"; 
                }else{
                    include 'datastore.php';
                    exit; 
                }
            }
        }
        ?>
    </body>
</html>