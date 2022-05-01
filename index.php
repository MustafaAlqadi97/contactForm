<?php  
//cheking if user come from arequest

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    //getting iputs values into variables 
    // filtering the input data 
    $firstN = htmlspecialchars($_POST['name']);
    $lastN = htmlspecialchars($_POST['surname']);
    $tel = filter_var( $_POST['number'] , FILTER_SANITIZE_NUMBER_INT );
    $msg = htmlspecialchars($_POST['message']);
    $email =filter_var(  $_POST['email'] , FILTER_SANITIZE_EMAIL );

    $theAllFormData = "my name is : ".$firstN ." ". $lastN . "my phone number is" .
    $tel . " " ." my email is" . $email . $msg;
    // echo "welcome " . $_POST['name']. $_POST['surname'];
    // var_dump($_POST);
    // echo $msg;

    //variables to store the errors
    $firstN_Error = '';
    $lastN_Error = '';
    $msg_Error = '';
    $tel_Error = '';
    
    //validation
    if (strlen($firstN) < 2 || strlen($firstN) > 50){
        $firstN_Error = 'user first name must be more than 2 characters';
    } 
    if (strlen($lastN) < 2 || strlen($lastN) > 50){
        $lastN_Error = 'user last name must be more than 2 characters';
    } 
    if (strlen($msg) <= 10 || strlen($msg) > 250){
        $msg_Error = 'your message must be more than 10 characters at least';
    } 
    if (strlen($tel) < 10 || strlen($tel) > 16){
        $tel_Error = 'Your Phone Number must be more than 10 numbers';
    } 

    $owner_name = "mustafaalqadi74@gmail.com";
    $from_contact = "Contact form from your website";

    // IF there is any errors send the mail
    if (empty($firstN_Error) && empty($lastN_Error) && empty($msg_Error) && empty($tel_Error)){
        mail( $owner_name , $from_contact ,$theAllFormData );
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="/all.min.css">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <!-- start container -->
    <div class="container"> <div class=" text-center mt-5 ">
        <!-- big head  -->
            <h1>Contact Me</h1>
        </div>
        <div class="row ">
            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container">
                            <!-- start form  -->
                            <form id="contact-form" role="form" action="<?php echo  $_SERVER['PHP_SELF'] ?>" method="post">
                                <!-- form inputs fields -->
                                <div class="controls">
                                    <!-- first row first & last name -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_name">First name </label>
                                                <input 
                                                    id="form_name"
                                                    type="text" 
                                                    name="name" 
                                                    class="form-control" 
                                                    placeholder="Please enter your firstname *" 
                                                    required="required" 
                                                    data-error="Firstname is required."
                                                    value="<?php if (isset($firstN)) { echo $firstN; } ?>" 
                                                />
                                                    <!--  to check first if there is formerrors values -->
                                                    <?php 
                                                        if(!empty($firstN_Error)){
                                                            echo "<div class='errors alert alert-danger alert-dismissible fade show' role='start'>";
                                                            
                                                                    echo $firstN_Error . "<br>";
                                                                
                                                            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'> </div>";
                                                        };
                                                    ?>
                                                    
                                                        
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_lastname">Last name </label> 
                                                <!-- print the inputed value by the user -->
                                                <input 
                                                    id="form_lastname"
                                                    type="text" 
                                                    name="surname" 
                                                    class="form-control" 
                                                    placeholder="Please enter your lastname *" 
                                                    required="required" 
                                                    data-error="Lastname is required."
                                                    value="<?php if (isset($lastN)) { echo $lastN; } ?>"
                                                    >
                                                <?php 
                                                        if(!empty($lastN_Error)){
                                                            echo "<div class='errors alert alert-danger alert-dismissible fade show' role='start'>";
                                                            
                                                                echo $lastN_Error . "<br>";
                                                            echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'> </div>";
                                                        };
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            <label for="form_email">Email </label> 
                                            <input id="form_email" 
                                                type="email" 
                                                name="email" 
                                                class="form-control" 
                                                placeholder="Please enter your email *" 
                                                required="required" 
                                                data-error="Valid email is required."
                                                value="<?php if (isset($email)) { echo $email; } ?>"
                                                > 
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="form_lastname">Phone </label>
                                                <input 
                                                    id="form_number" 
                                                    type="number" name="number" 
                                                    class="form-control" 
                                                    placeholder="Please enter your phone number *" 
                                                    required="required" 
                                                    data-error="phone Number is required."
                                                    value="<?php if (isset($tel)) { echo $tel; } ?>"
                                                    >
                                                <?php 
                                                    if(!empty($tel_Error)){
                                                        echo "<div class='errors alert alert-danger alert-dismissible fade show' role='start'>";
                                                        echo $tel_Error . "<br>";
                                                        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'> </div>";
                                                    };
                                                ?>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group"> <label for="form_message">Message </label>
                                            <textarea 
                                                id="form_message" 
                                                name="message" 
                                                class="form-control" 
                                                placeholder="Write your message here." 
                                                rows="4" required="required" 
                                                data-error="Please, leave us a message."
                                                ><?php if (isset($msg)) { echo $msg; } ?></textarea> 
                                        </div>
                                            <?php 
                                                if(!empty($msg_Error)){
                                                    echo "<div class='errors alert alert-danger alert-dismissible fade show' role='start'>"; 
                                                    echo $msg_Error . "<br>";
                                                    echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'> </div>";
                                                };
                                            ?>
                                        </div>
                                        <div class="col-md-12"> <input type="submit" class="btn btn-success btn-send pt-2 btn-block " value="Send Message"> </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> <!-- /.8 -->
                </div> <!-- /.row-->
            </div>
        </div>

    <script src="bootstrap.bundle.min.js"></script>
    <script src="/JQUERY.js"></script>
    <script src="/all.min.js"></script>
</body>
</html>