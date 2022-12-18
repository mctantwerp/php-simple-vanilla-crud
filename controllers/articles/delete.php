<?php
deleteArticle($conn, $_GET['id']);

flash('msg', 'Article is deleted');
redirect('index.php?page=articles');
