<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <!-- <title>Document</title> -->
</head>

<body>
    <?php
    include 'utility.php';
    $conn = conDatabase();
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_GET['beli']) and isset($_GET['stock'])){
        handleBeli($_GET['beli'],$_GET['stock']);
    }
    
    if (isset($_GET['detail'])) {
        $result = getDetail($_GET['detail']);
        // echo $result;
        $row_detail = $result->fetch_assoc(); 
        // echo $row_detail['name'];
    }
    if (isset($_GET['delete'])) {
        $result = deletCarId($_GET['delete']);
        // echo $result;
        // $row_detail = $result->fetch_assoc(); 
        // echo $row_detail['name'];
    }
    // echo $msg;
    ?>
    <div class="container">
        <h1> Welcome To Cars Store </h1>
        <div class="content">

            <form action="handleTambah.php" class="tambah_mobil" method="POST" enctype= "multipart/form-data">
                
                <label for="">Name</label>
                <input name="name" type="text" placeholder="name" required/>
                <!-- <input type="text" value="Name" /> -->
                
                <label for="">Brand</label>
                <select name="brand" required>    
                    <?php 
                        $brand = getBrand($conn);
                        while($row = $brand->fetch_assoc()){
                    ?>
                        <option  value="<?php echo $row["id"] ?>" > <?php echo $row["name"] ?></option>
                    <?php
                        }
                        // echo $brand;
                    ?>
                    <!-- <option value="onda"></option> -->
                </select>
                <!-- <input type="text" value="Brand" /> -->

                <label for="">Color</label>
                <input name="color" type="text" placeholder="color" required/>
                
                <label for="">Stock</label>
                <input name="stock" type="number" placeholder="99" required/>

                <label for="">Select Image Only in - <br>path_to_htdoc/20FEB21</label>
                <input name="image" type="file" accept="image/*" value="Color" required/>
                    
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="10" required > </textarea>
                <!-- <input type="text" value="" /> -->
                
                <input class="buy" type="submit" value="Tambah Mobil" name="submit" />
            </form>

            <div class="list_mobil">
                <?php 
                    $getallcar = getAllCars();
                    while($row = $getallcar->fetch_assoc()){
                ?>
                    <div class="car_container">
                        <img width="200px" height="120px" src="images/<?php echo $row["image"] ?>" alt="">
                        <h2><?php echo $row['name'] ?></h2>
                        <a class="buy" href="index.php?beli=<?php echo $row['id'] ?>&stock=<?php echo $row['stock']?>">Beli</a>
                        <a class="detail" href="index.php?detail=<?php echo $row['id'] ?>">Detail</a>
                    </div>
                <?php
                    }
                ?>
            </div>

            <form class="tambah_mobil form2">
                <img width="100%" height="150" src="<?php if (empty($row_detail['image'])){ echo "https://via.placeholder.com/150"; }else{echo "images/".$row_detail['image']."";} ?>"/>
                <label for="">Name</label>
                <input name="name" type="text" value="<?php if (empty($row_detail['name'])){ echo "~Empty~"; }else{ echo $row_detail['name'];}?>" disabled/>
                <!-- <input type="text" value="Name" /> -->
                
                <label for="">Brand</label>
                <select name="brand" disabled>    
                    <option value="<?php if (empty($row_detail['color'])){ echo "0"; }else{echo $row_detail['brand_id'];}?>"><?php if (empty($row_detail['brandName'])){ echo "~Empty~"; }else{echo $row_detail['brandName'];}?></option>
                    <!-- <option value="onda"></option> -->
                </select>
                <!-- <input type="text" value="Brand" /> -->

                <label for="">Color</label>
                <input name="color" type="text" value="<?php if (empty($row_detail['color'])){ echo "~Empty~"; }else{echo $row_detail['color'];}?>" placeholder="color" disabled/>
                
                <label for="">Stock</label>
                <input name="stock" type="number" value="<?php if (empty($row_detail['stock'])){ echo 0; }else{ echo $row_detail['stock'];}?>" placeholder="99" disabled/>

                <!-- <label for="">Select Image Only in - <br>path_to_htdoc/20FEB21</label>
                <input name="image" type="file" accept="image/*" value="Color" disabled/> -->
                    
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="10" disabled ><?php if (empty($row_detail['description'])){ echo "~Empty~"; }else{echo $row_detail['description'];}?> </textarea>
                <!-- <input type="text" value="" /> -->
                
                <a class="buy <?php if (empty($row_detail['id'])){ echo "disabled"; } ?>" href="index.php?delete=<?php echo $row_detail['id'] ?>"  >Delete</a>
                <a class="detail" href="index.php">Close</a>
                <!-- <a type="submit" value="submit" name="submit" /> -->
            </form>
        </div>
    </div>
</body>

</html>