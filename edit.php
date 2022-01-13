<?php
    include 'model.php';
    $id = $_POST['id'];
    $model = new Model();
    $row = $model->edit($id);
    if (!empty($row)) { ?>
        <form id="form" action="post">
            <div>
                <input type="hidden" id="edit_id" value="<?php echo $row['id'] ?>">
            </div>
            <div class="form-group">
                <label for="">Phone brand</label>
                <input type="text" id="edit_phone_brand" class="form-control" value="<?php echo $row['phone_brand']; ?>">
            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="text" id="edit_price" class="form-control" value="<?php echo $row['price']; ?>">
            </div>
            <div class="form-group">
                <label for="edit_Phone_modelId">Choose a phone:</label>
                <select id="edit_Phone_modelId">
                  <?php
                    $phone_models = $model->fetchPhone_models();
                    foreach ($phone_models as $phone_model) {
                        echo "<option value='{$phone_model['id']}'>{$phone_model['phone_model']}</option>";
                    }
                  ?>
                </select>
              </div>
        </form>
    <?php
    }
?>