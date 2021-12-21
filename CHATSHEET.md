## Login with a hash

```php
if($_POST['email'] == 'test@test.be' && password_verify($_POST['password'], '$2y$10$wrIw6sWIJgWTcFbaRO9MVusfj6B/uvv0oObBWFA/AjfzslSRL4Fui'))
```
