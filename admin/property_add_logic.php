<?php
session_start();
require("config.php");

class PropertyProcessor {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function processPropertyAddition($postData) {
        // Initialize variables
        $error = '';
        $msg = '';

        // Process property addition logic
        $title = $_POST['title'];
        $content = $_POST['content'];
        $ptype = $_POST['ptype'];
        $bhk = $_POST['bhk'];
        $bed = $_POST['bed'];
        $balc = $_POST['balc'];
        $hall = $_POST['hall'];
        $stype = $_POST['stype'];
        $bath = $_POST['bath'];
        $kitc = $_POST['kitc'];
        $floor = $_POST['floor'];
        $price = $_POST['price'];
        $city = $_POST['city'];
        $asize = $_POST['asize'];
        $loc = $_POST['loc'];
        $state = $_POST['state'];
        $status = $_POST['status'];
        $uid = $_POST['uid'];
        $feature = $_POST['feature'];

        $totalfloor = $_POST['totalfl'];

        $aimage = $_FILES['aimage']['name'];
        $aimage1 = $_FILES['aimage1']['name'];
        $aimage2 = $_FILES['aimage2']['name'];
        $aimage3 = $_FILES['aimage3']['name'];
        $aimage4 = $_FILES['aimage4']['name'];

        $fimage = $_FILES['fimage']['name'];
        $fimage1 = $_FILES['fimage1']['name'];
        $fimage2 = $_FILES['fimage2']['name'];

        $isFeatured = $_POST['isFeatured'];

        $temp_name = $_FILES['aimage']['tmp_name'];
        $temp_name1 = $_FILES['aimage1']['tmp_name'];
        $temp_name2 = $_FILES['aimage2']['tmp_name'];
        $temp_name3 = $_FILES['aimage3']['tmp_name'];
        $temp_name4 = $_FILES['aimage4']['tmp_name'];

        $temp_name5 = $_FILES['fimage']['tmp_name'];
        $temp_name6 = $_FILES['fimage1']['tmp_name'];
        $temp_name7 = $_FILES['fimage2']['tmp_name'];

        move_uploaded_file($temp_name, "property/$aimage");
        move_uploaded_file($temp_name1, "property/$aimage1");
        move_uploaded_file($temp_name2, "property/$aimage2");
        move_uploaded_file($temp_name3, "property/$aimage3");
        move_uploaded_file($temp_name4, "property/$aimage4");

        move_uploaded_file($temp_name5, "property/$fimage");
        move_uploaded_file($temp_name6, "property/$fimage1");
        move_uploaded_file($temp_name7, "property/$fimage2");

        // Example: Insert into the database
        $sql = "INSERT INTO property (title, pcontent, type, bhk, stype, bedroom, bathroom, balcony, kitchen, hall, floor, size, price, location, city, state, feature, pimage, pimage1, pimage2, pimage3, pimage4, uid, status, mapimage, topmapimage, groundmapimage, totalfloor, isFeatured) VALUES ('$title','$content','$ptype','$bhk','$stype','$bed','$bath','$balc','$kitc','$hall','$floor','$asize','$price',
        '$loc','$city','$state','$feature','$aimage','$aimage1','$aimage2','$aimage3','$aimage4','$uid','$status','$fimage','$fimage1','$fimage2','$totalfloor','$isFeatured')";
        $result = mysqli_query($this->db, $sql);

        // Check the result and set appropriate messages
        if ($result) {
            $msg = '<p class="alert alert-success">Property Inserted Successfully</p>';
        } else {
            $error = '<p class="alert alert-warning">Something went wrong. Please try again</p>';
        }

        // Return the result
        return ['error' => $error, 'msg' => $msg];
    }
}
?>
