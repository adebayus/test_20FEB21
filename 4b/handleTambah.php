<?php
    if(isset($_POST['submit'])){
        include 'utility.php';

        $name = $_POST['name'];
        
        $conn = conDatabase();
        // $name ="Brio";
        
        $isFound = cekCars($name);
        if($isFound===true){
            // echo "Asdasds";
            echo "<script>
            alert('Maaf data mobil sudah ada, masukan data mobil yang baru');
            window.location.href='index.php';
            </script>";
        // sleep(10);
        // header("Location: index.php");
        }
        else{

            $brand = $_POST['brand'];
            $color = $_POST['color'];
            $image = $_POST['image'];
            $description =  $_POST['description'];
            $stock =  $_POST['stock'];
            insertCar($name, $brand, $color, $stock, $image, $description);
        }
        


        
        // $name = ;
        // echo "{$_POST['description']} {$_}";

    }

?>