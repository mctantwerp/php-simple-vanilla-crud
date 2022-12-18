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
                <div class="col-sm-11"><h2>Users</h2></div>
                <div class="col-sm-1">
                    <a href="index.php?page=users&action=add" class="btn btn-info add-new"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $user): ?>
                <tr>
                    <td><?= $user['email']; ?></td>
                    <td>
                        <a href="?page=users&action=edit&id=<?= $user['id']; ?>" class="edit" title="Edit"><i class="material-icons">&#xE254;</i></a>
                        <a href="?page=users&action=delete&id=<?= $user['id']; ?>" class="delete" title="Delete"><i class="material-icons">&#xE872;</i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
