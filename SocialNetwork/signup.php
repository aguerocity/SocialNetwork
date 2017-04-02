<html>

<head>











<style>

body{

color:white;
}

</style>

</head>

<body background="signup.jpg">
<center><h1> CHATTERBOX REGISTRATION</h1></center>

<form action="submit.php" method="post">
<pre>
                    <center> <input type="text" name="name" placeholder="Name"/></br></center></br>

USERNAME:<input type="text" name="uname" placeholder="username" onKeyup="show(this.value)" required="required"/>      PASSWORD:<input type="password" name="pass" placeholder="password" required="required"/>       BIRTHDATE:<input type="date" name="dob" />
</br>
<span id="un" ></span>
</br>
GENDER  :<select name="gender"> <option value="male">male</option> <option value="female">female </option></select>                      COUNTRY:<input type="text" name="country" placeholder="country"/>            CITY:<input type="text" name="city" placeholder="city"/>   
</br>


STATE   :<input type="text" name="state" placeholder="state"/>         EMAIL:<input type="email" name="email" placeholder="email-id"/>    ORGANISATION:<input type="text" name="org" placeholder="school/college"/>
</br>
  </br> 
                                                        <input type="submit" value="SIGN-UP"/> 
</pre>
</form>



<script>
function show(str) {
    
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("un").innerHTML = xmlhttp.responseText;

document.getElementsById("un").style.backgroundColor=white;

            }
        };
        xmlhttp.open("GET", "gethint.php?q=" + str, true);
        xmlhttp.send();
    }

</script>
 