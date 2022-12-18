
<section class="main">
    <div class="row">
        <h1><?= $titel_action; ?></h1>

        <div class="col-md-12">

        <?php
            if(!empty($msg = flash('msg')))
            {
                echo '<div class="alert alert-danger" role="alert">';
                echo $msg;
                echo '</div>';
            }
        ?>

        <form action="<?= $form_action; ?>" method="post">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?= $email ?? old('email'); ?>">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" value="">
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Save user</button>
        </form>
        </div>
    </div>
</section>
