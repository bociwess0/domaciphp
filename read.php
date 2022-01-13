<?php

    include 'model.php';
    $model = new Model();
    $row = $model->read($_POST['id']);
    if (!empty($row)) { ?>
        <p>Brand - <?php echo $row['phone_brand']; ?></p>
        <p>Price - <?php echo $row['price']; ?></p>
        <p>Model - <?php echo "{$row['phone_model']}" ?></p>
    <?php
    }

?>