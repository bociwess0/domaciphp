<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Mobile phones</title>
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
              <h1 class="text-center">Mobile phones</h1>
              <hr style="height: 1px; color:black;background-color:black;">
            </div>
        </div>
        <div class="row">
          <div class="col-md-5 mx-auto">
            <h2 class="text-center">Insert phone:</h2>
            <form action="" method="post" id="form">
              <div id="result"></div>
              <div class="form-group">
                <label for="">Phone brand:</label>
                <input type="text" id="phone_brand" class="form-control">
              </div>
              <div class="form-group">
                <label for="">Price</label>
                <input type="text" id="price" class="form-control">
              </div>
              <div class="form-group">
                <label for="phone_models">Choose an phone_model:</label>
                <select id="selectedPhone_modelId">
                  <?php
                    include "model.php";
                    $model = new Model();
                    $phone_models = $model->fetchPhone_models();
                    foreach ($phone_models as $phone_model) {
                        echo "<option value='{$phone_model['id']}'>{$phone_model['phone_model']}</option>";
                    }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <button type="submit" id="submit" class="btn btn-outline-primary">Submit</button>
              </div>
            </form>
            <h2 class="text-center">Insert a phone model:</h2>
            <form action="" method="post" id="formPhone_model">
              <div id="resultPhone_model"></div>
              <div class="form-group">
                <label for="">Model name</label>
                <input type="text" id="phone_model" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" id="submitPhone_model" class="btn btn-outline-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 mt-1">
            <div id="show"></div>
            <div id="fetch"></div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="readModal" tabindex="-1" aria-labelledby="readModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="readModalTitle">Record</h5>
          </div>
          <div class="modal-body">
            <div id="read_data"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editModalTitle">Edit Record</h5>
          </div>
          <div class="modal-body">
            <div id="edit_data"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="update">Update</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script>
      $(document).on("click", "#submit", function(e) {
        e.preventDefault();
        var phone_brand = $("#phone_brand").val();
        var price = $("#price").val();
        var selectedPhone_modelId = $("#selectedPhone_modelId").val();
        var submit = $("#submit").val();
        $.ajax({
          url: "insert.php",
          type: "post",
          data: {
            phone_brand:phone_brand,
            price:price,
            submit:submit,
            selectedPhone_modelId:selectedPhone_modelId
          },
          success: function(data) {
            fetch();
            $("#result").html(data);
          }
        });
        $("#form")[0].reset();
        $("#form")[1].reset();
      });

      $(document).on("click", "#submitPhone_model", function(e) {
        e.preventDefault();
        var phone_model = $("#phone_model").val();
        var submitPhone_model = $("#submitPhone_model").val();
        $.ajax({
          url: "insertPhone.php",
          type: "post",
          data: {
            phone_model:phone_model,
            submitPhone_model:submitPhone_model
          },
          success: function(data) {
            fetch();
            $("#resultPhone_model").html(data);
          }
        });
        $("#formPhone_model")[0].reset();
        $("#formPhone_model")[1].reset();
      });

      // Fetch phones
      function fetch() {
        $.ajax({
          url: 'fetch.php',
          type: 'post',
          success: function(data) {
            $("#fetch").html(data)
          }
        });
      }

      // Delete phone
      $(document).on('click', '#delete', function(e) {
        e.preventDefault();
        if (window.confirm('Do you want to delete the record?')) {
          var id = $(this).attr('value');
          $.ajax({
            url: "delete.php",
            type: "post",
            data: {
              id:id
            },
            success: function(data) {
              fetch();
              $("#show").html(data);
            }
          });
        }
        else {
          return false;
        }
      });

      // Read phones
      $(document).on('click', '#read', function(e) {
        e.preventDefault();
        var id = $(this).attr('value');
        $.ajax({
          url: 'read.php',
          type: 'post',
          data: {
            id:id
          },
          success: function(data) {
            $('#read_data').html(data);
          }
        })
      });

      // Edit phones
      $(document).on('click', '#edit', function(e) {
        e.preventDefault();
        var id = $(this).attr('value');
        $.ajax({
          url: 'edit.php',
          type: 'post',
          data: {
            id:id
          },
          success: function(data) {
            $('#edit_data').html(data);
          }
        });
      });

      // Update phones
      $(document).on("click", "#update", function(e){
        e.preventDefault();
        var edit_id = $("#edit_id").val();
        var edit_phone_brand = $("#edit_phone_brand").val();
        var edit_price = $("#edit_price").val();
        var edit_Phone_modelId = $("#edit_Phone_modelId").val();
        var update = $("#update").val();
        $.ajax({
          url: "update.php",
          type: "post",
          data: { 
            edit_id:edit_id,
            edit_phone_brand:edit_phone_brand,
            edit_price:edit_price,
            edit_Phone_modelId:edit_Phone_modelId,
            update:update
          },
          success: function(data){
            fetch();
            $("#show").html(data);
          }
        });
      });
    </script>
  </body>
</html>