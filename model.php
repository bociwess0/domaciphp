<?php

    Class Model{
        private $server = "localhost";
        private $username = "root";
        private $password;
        private $db = "phphomework";
        private $conn;

        public function __construct(){
            try {
                $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            } catch (Exception $e) {
                echo "Connection failed" . e.getMessage();
            }
        }

        public function ret(){
            return $this->conn;
        }

        public function insert(){
            if (isset($_POST['submit'])) {
                if (isset($_POST['phone_brand']) && isset($_POST['price']) && isset($_POST['selectedPhone_modelId'])) {
                    if (!empty($_POST['phone_brand']) && !empty($_POST['price']) && !empty($_POST['selectedPhone_modelId'])) {
                        $phone_brand = $_POST['phone_brand'];
                        $price = $_POST['price'];
                        $selectedPhone_modelId = $_POST['selectedPhone_modelId'];
                        $query = "INSERT INTO phones (phone_brand, price, phone_model) VALUES ('$phone_brand', '$price', '$selectedPhone_modelId')";
                        if ($sql = $this->conn->exec($query)) {
                            echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Phone added successfully!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            ";
                        }
                        else {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Failed to add the phone!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            ";
                        }
                    } else {
                        echo "
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Empty field(s)!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        ";
                    }
                }
            }
        }

        public function insertPhone(){
            if (isset($_POST['submitPhone_model'])) {
                if (isset($_POST['phone_model'])) {
                    if (!empty($_POST['phone_model'])) {
                        $phone_model = $_POST['phone_model'];
                        $query = "INSERT INTO phone_models (phone_model) VALUES ('$phone_model')";
                        if ($sql = $this->conn->exec($query)) {
                            echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Phone model added successfully!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            ";
                        }
                        else {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Failed to add the phone model!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            ";
                        }
                    } else {
                        echo "
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                Empty field(s)!
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        ";
                    }
                }
            }
        }

        public function fetch() {
            $data = null;
            $stmt = $this->conn->prepare("SELECT phones.id, phones.phone_brand, phones.price, phone_models.phone_model FROM phones JOIN phone_models on phones.phone_model = phone_models.id");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }

        public function fetchPhone_models() {
            $data = null;
            $stmt = $this->conn->prepare("SELECT * FROM phone_models");
            $stmt->execute();
            $data = $stmt->fetchAll();
            return $data;
        }

        public function read($id) {
            $data = null;
            $stmt = $this->conn->prepare("SELECT phones.id, phones.phone_brand, phones.price, phone_models.phone_model FROM phones JOIN phone_models on phones.phone_model = phone_models.id WHERE phones.id='$id'");
            $stmt->execute();
            $data = $stmt->fetch();
            return $data;
        }

        public function delete($id){
            $query = "DELETE FROM phones WHERE id = '$id' ";
            if ($sql = $this->conn->exec($query)) {
                echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Phone deleted successfully!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
            } else {
                echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Phone not deleted!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                ";
            }
        }

        public function edit($id) {
            $data = null;
            $stmt = $this->conn->prepare("SELECT * FROM phones WHERE id='$id'");
            $stmt->execute();
            $data = $stmt->fetch();
            return $data;
        }

        public function update($data) {
            $query = "UPDATE phones SET phone_brand = '$data[edit_phone_brand]', price = '$data[edit_price]', phone_model = '$data[edit_Phone_modelId]'
            WHERE id='$data[edit_id]'";
      
            if ($sql = $this->conn->exec($query)) {
              echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Phone updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <script>$("#editModal").modal("hide")</script>
                ';
            }else {
              echo '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Phone not updated!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                ';
            }
          }
    }

?>