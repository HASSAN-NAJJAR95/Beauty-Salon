<?php
include './inc/connect.php';
include './inc/array.php';
/*Form Variables */
@$firstName= $_POST['firstName'];
@$lastName= $_POST['lastName'];
@$email= $_POST['email'];
@$phoneNumber = $_POST['phoneNumber'];
@$letter= $_POST['letter'];
/*For form */
if(isset($_POST['submit1'])){
    @$sql_form= "INSERT INTO form(firstName, lastName, email, phoneNumber, letter)
                            VALUES('$firstName','$lastName','$email','$phoneNumber', '$letter')";
    if(empty($firstName)){
        $errors['firstName']= 'Please Input First Name';
    }if(empty($lastName)){
        $errors['lastName']= 'Please Input Last Name';
    }if(empty($email)){
        $errors['email']= 'Please Input Your Mail';
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']= 'Please Input Correct Email';
    }if(empty($phoneNumber)){
        $errors['phoneNumber']= 'Please Input Phone Number';
    }if(empty($letter)){
        $errors['letter']= 'Please Input Your Message';
    }else{
        if(mysqli_query($con, $sql_form)){
            $text['send'] = "<script>alert('Your message is send successfully');</script>";
            $text['disabled2']= 'disabled';

        }else{
            echo 'Fail: '.mysqli_error($con);
        }
    }
}
if(isset($_POST['submit2'])){
    header('Location: contact.php');
}
/*Products Variables*/
@$productName= $_POST['productName'];
@$productPrice= $_POST['productPrice'];
@$productImage= $_FILES['productImage']['name'];
@$target= "images/".basename($_FILES['productImage']['name']);
@$cardName= $_POST['cardName'];
@$cardNumber= $_POST['cardNumber'];
@$codeNumber= $_POST['codeNumber'];


/*From Control Panel */
if(@$_POST['submit3']){
    @$sqlInsert = "INSERT INTO products(productName, ProductPrice, productImage)
                            VALUES('$productName','$productPrice','$productImage')";
        if(empty($productName)){
            $errors['productName']= 'Please Input Product Name';
        }
        if(empty($productPrice)){
            $errors['productPrice']= 'Please Input Product Price';
        }
        if(empty($productImage)){
            $errors['productImage']= 'Please Input Product Image';
        }
        else{
            /*Send To DataBase */
                if(mysqli_query($con, $sqlInsert)){
                    $text['postDone']= 'Posting Done!';
                    $text['disabled']= 'disabled';
                }
            
            if(move_uploaded_file($_FILES['productImage']['tmp_name'], $target)){
                 $errors['productImage']= 'Image Upload!';
            }
        }
}
/*For Refresh Page */
if(@$_POST['submit4']){
    header('Location: controlpanel.php');
}

/*For Shop Products */
if(isset($_POST['submit5'])){
    @$sqlshop = "INSERT INTO productsshop(firstName, lastName, email,productName, cardName, cardNumber, codeNumber)
                                    VALUES('$firstName','$lastName','$email', '$productName','$cardName', '$cardNumber','$codeNumber')";
    if(empty($firstName)){
        $errors['firstName']= 'Please Input First Name';
    }if(empty($lastName)){
        $errors['lastName']= 'Please Input Last Name';
    }if(empty($email)){
        $errors['email']= 'Please Input Your Mail';
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email']= 'Please Input Correct Email';
    }if(empty($productName)){
        $errors['productName'] = 'Please Input Product Name';
    }if(empty($cardName)){
        $errors['cardName'] = 'Please Input Card Name';
    }if(empty($cardNumber)){
        $errors['cardNumber'] = 'Please Input Number Name';
    }if(empty($codeNumber)){
        $errors['codeNumber'] = 'Please Input Code Number';
    }else{
            if(mysqli_query($conn, $sqlshop )){
                $text['buyProduct1']= '<script>alert("The product has been successfully purchased");</script>';
                
            }else{
                $text['buyProduct1']= '<script>alert(" Fail: ' . mysqli_error($conn). '  ");</script>';
            }
    }
}

/*Fetch Data */
$sql_fetch = "SELECT * FROM products";
$result= mysqli_query($con, $sql_fetch);
$newproduct = mysqli_fetch_all ($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($con);
