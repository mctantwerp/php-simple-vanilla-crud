<?php
if(isset($_POST['password']))
{
    echo password_hash($_POST['password'], PASSWORD_DEFAULT);
}
?>

<form method="POST" action="hashme.php">
    Password: <input type="password" name="password" /><br /><br />
    <input type="submit" value="Verzenden" />
</form>
