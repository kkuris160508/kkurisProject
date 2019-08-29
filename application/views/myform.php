<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 2019-08-29
 * Time: 오전 11:21
 */

?>


<head>
    <title>My form</title>
</head>
<body>
<?php echo validation_errors();?>

<?php echo form_open('form');?>

<h5>UserName</h5>
<input type="text" name="username" value="" size="50"/>

<h5>PassWord</h5>
<input type="text" name="password" value="" size="50"/>

<h5>PassWord Confirm</h5>
<input type="text" name="passconf" value="" size="50"/>

<h5>Email Address</h5>
<input type="text" name="email" value="" size="50"/>

<div><input type="submit" value="Submit" /></div>

</form>
</body>
</html>
