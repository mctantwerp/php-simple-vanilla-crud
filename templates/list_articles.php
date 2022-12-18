<div class="container main">
    <?php
        if(!empty($msg = flash('msg')))
        {
            echo '<div class="alert alert-danger" role="alert">';
            echo $msg;
            echo '</div>';
        }
    ?>

    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-11"><h2>Artikels</h2></div>
                <div class="col-sm-1">
                    <a href="index.php?page=add" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Titel</th>
                    <th>Inhoud</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($articles as $article): ?>
                <tr>
                    <td><?= substr($article['title'], 0, 15); ?></td>
                    <td><?= substr($article['article'], 0, 15); ?></td>
                    <td>
                        <a href="?page=home&action=edit&id=<?= $article['id']; ?>" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                        <a href="?page=home&action=delete&id=<?= $article['id']; ?>" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
