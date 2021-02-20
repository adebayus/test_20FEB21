<?php
    function writeMsg(){
        return "echo";
    }

    function conDatabase(){
       return mysqli_connect('localhost','root','','dumbways');
    }

    function getBrand($conn){
        $sql = "SELECT * From brand";
        $result = $conn->query($sql);
        if($result->num_rows > 0 ){
            return $result;
        }else{
            return 'error';
        }
        // return 
    }

    function cekCars($name){
        // $name = "Brio";
        $conn = conDatabase();
        $sql = "SELECT * From cars WHERE name='". $name ."'" ;
        $result = $conn->query($sql);
        // return $result;
        if($result->num_rows > 0 ){
            return true ;
        }else{
            return false;
        }
    }
    function insertCar($name,$brand,$color,$stock,$image,$description){
        $conn = conDatabase();
        $sql = "INSERT INTO `cars` (`id`, `name`, `brand_id`, `image`, `color`, `description`, `created_time`, `update_time`, `stock`) VALUES (NULL, '$name', $brand, '$image', '$color', '$description', current_timestamp(), current_timestamp(), $stock)";
        if($conn->query($sql) === TRUE){
            echo "<script>
            alert('Data berhasil diinput');
            window.location.href='index.php';
            </script>";
        }else{
            echo "<script>
            alert('Data gagal diinput');
            window.location.href='index.php';
            </script>";
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    function getAllCars(){
        $conn = conDatabase();
        $sql = "SELECT * FROM cars where stock>0";
        $result = $conn->query($sql);
        return $result;
    }

    function handleBeli($id,$stock){
        $conn = conDatabase();
        $stockminus = $stock - 1;
        // echo $stockminus;
        $sql = "UPDATE cars SET stock=". $stockminus ." WHERE id=". $id ."";
        $result = $conn->query($sql);
        if($result === TRUE){
            echo "<script>
            alert('Berhasil Membeli');
            window.location.href='index.php';
            </script>";
        }
        else {
            echo "<script>
            alert('Gagal Membeli');
            window.location.href='index.php';
            </script>";
        }

        
    }

    function getDetail($id){
        $conn = conDatabase();
        $sql = "SELECT cars.*, brand.name as brandName From cars JOIN brand ON cars.brand_id=brand.id WHERE cars.id={$id}" ;
        $result = $conn->query($sql);
        // $fetch = $result->fetch_assoc();
        // echo $fetch['id'];
        return $result;
        // return "Error: " . $sql . "<br>" . $conn->error;
    }
    
    function deletCarId($id){
        $conn = conDatabase();
        $sql = "DELETE FROM cars WHERE id={$id}" ;
        $result = $conn->query($sql);
        if($result === TRUE){
            echo "<script>
            alert('Berhasil Menghapus');
            window.location.href='index.php';
            </script>";
        }
        else {
            echo "<script>
            alert('Gagal Menghapus');
            window.location.href='index.php';
            </script>";
        }
    }

?>