<?php 
include "model.php";
if (isset($_POST['update'])) {
    if (isset($_POST['edit_phone_brand']) && isset($_POST['edit_price']) && isset($_POST['edit_id']) && isset($_POST['edit_Phone_modelId'])) {
        if (!empty($_POST['edit_phone_brand']) && !empty($_POST['edit_price']) && !empty($_POST['edit_id']) && !empty($_POST['edit_Phone_modelId'])) {
            $data['edit_id'] = $_POST['edit_id'];
            $data['edit_phone_brand'] = $_POST['edit_phone_brand'];
            $data['edit_price'] = $_POST['edit_price'];
            $data['edit_Phone_modelId'] = $_POST['edit_Phone_modelId'];
            $model = new Model();
            $update = $model->update($data); 
        } else {
            echo "
            <script>alert('Empty field(s)!')</script>
            ";
        }
    }
}
?>