
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
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?= $title ?? old('title'); ?>">
          </div>
          <div class="form-group">
            <label for="article">Article</label>
            <textarea class="form-control" id="article" rows="10" name="article"><?= $article ?? old('article'); ?></textarea>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Save article</button>
        </form>
        </div>
    </div>
</section>
