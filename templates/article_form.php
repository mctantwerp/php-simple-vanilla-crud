
<section class="main">
    <div class="row">
        <h1><?php echo $titel_action; ?></h1>

        <div class="col-md-12">

        <?php
            if(isset($msg))
            {
                echo '<div class="alert alert-danger" role="alert">';
                echo $msg;
                echo '</div>';
            }
        ?>

        <form action="<?php echo $form_action; ?>" method="post">
          <div class="form-group">
            <label for="titel">Titel</label>
            <input type="text" class="form-control" id="titel" name="titel" value="<?php echo (isset($titel)) ? $titel : ""; ?>">
          </div>          
          <div class="form-group">
            <label for="inhoud">Inhoud</label>
            <textarea class="form-control" id="inhoud" rows="10" name="inhoud"><?php echo (isset($inhoud)) ? $inhoud : ""; ?></textarea>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Artikel opslaan</button>
        </form>
        </div>
    </div>
</section class="main">