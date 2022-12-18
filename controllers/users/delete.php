<?php
deleteUser($conn, $_GET['id']);

flash('msg', 'User deleted');
redirect('index.php?page=users');
