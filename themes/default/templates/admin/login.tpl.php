<style>
#header, #footer {
    background-color:#e79500;
    color:white;
    text-align:center;
	height: 50px;
	padding: 5px
}

#section {
    background-color:#f9d599;
	padding: 10px
}



table {
        border-collapse: separate;
        border-spacing: 10px 5px;
      }


td {
    border:  1px solid black <!--#1d93d1 -->;
	padding: 5px;
	margin: 5px;
}


#btnlogin 

{
    background: #f5b312;
    border: 1px solid #c6c6c6;
    background: #f5b312;
    border-color: #E78282;
    margin: 10px 0 0 0;
    color: #fff;
    right: 9px;
    bottom: 9px;
    font-size: 17px;
    width: 103px;
    height: 35px;
    outline: none;
    cursor: pointer;

}

#user_name, #user_password {
    padding: 0 8px;
    margin: 4px auto;
    background: #fff;
    border: 1px solid #d9d9d9;
    border-top: 1px solid silver;
    border-radius: 1px;
    color: #838383;
    width: 280px;
    box-sizing: border-box;
    direction: ltr;
    height: 30px;
    font-size: 16px;
    text-align: left;
}


#name:hover,#pass:hover {
    border: 1px solid #b9b9b9;
    border-top: 1px solid #a0a0a0;
    box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
}




</style>

<div id="header">
</div>



<div id="section" class='container' >
<table>
<td height="490px"><img src="<?=$themeImagesPath?>admin/ssi_logo_orange.jpg" alt="" align="right" style="width:auto; height:auto;"></td>
<td>
    <div id="userbox">
    	<form method="post" action="">
        <input name="user_name" id="user_name" placeholder="ID" style="opacity: 1; background-color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;"><br><br>
        <input name="user_password" id="user_password" type="password" placeholder="Password" style="opacity: 1; background-color: rgb(255, 255, 255); background-position: initial initial; background-repeat: initial initial;"><br>
        <p id="name" style="display: none; opacity: 1;">ID:</p><br>
        <p id="pass" style="display: none; opacity: 1;">Password:</p>
        <input id="btnlogin" type="Submit" value="Login" name="Submit"/>
        <input id="btnlogin" type="reset" value="Clear" name="Submit2" />
		<!-- <a href=" ">Forgot Password</a> -->
		</form>
    </div>
</td>

</table>
</div>

<div id="footer">
<p>Copyright Sagesoft Solution Inc. &copy; 2015</p>
</div>