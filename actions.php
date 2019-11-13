<?php
include("tool/functions.php");

$error = "";
if ($_GET["action"] == "login") 
{
    $email = $_POST['email'];
    $password =$_POST['password'];
    if (!$email) {
        $error = "Email id is empty!";
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Email id is invalid!";
    }
    if (!$password) {
        $error = "Password cannot be empty!";
    }
    if($error==""){
        $query = "SELECT * FROM faculty WHERE email= '$email'";
        $res=mysqli_query($mySql_db,$query);
        $row = mysqli_fetch_assoc($res);
        if($row["password"]==$password){
            $_SESSION["email"]=$email;
            echo 1;
        }
        else{
            $error ="Invalid Email or Password!";           
        }
    }
    if($error!=""){
        echo $error;
    }
} 

else if($_GET['action']=="save_profile")
{
    $collection = $database->user;
    $data = array('email' => $_SESSION["email"]);
    $count = $collection->findOne($data);
    if (!count($count)) {
        $user = array('email' => $_SESSION["email"], 'biography' => $_POST["biography"],'research_area' => $_POST["research_area"] ,'education' => $_POST["education"],'experience' => $_POST["experience"],'patents' => $_POST["patents"]);
        $collection->save($user);
    }
    else {
        $newdata = array('$set' => array('biography' => $_POST["biography"],'research_area' => $_POST["research_area"] ,'education' => $_POST["education"],'experience' => $_POST["experience"],'patents' => $_POST["patents"]));
        $collection->update(array("email" =>$_SESSION["email"]), $newdata);
    }
    echo $_SESSION["email"];
}
else if($_GET['action']=="unset"){
    unset($_SESSION['email']);
    echo 1;
}
else if ($_GET["action"] == "CSE" || $_GET["action"] == "EE" || $_GET["action"] == "ME") 
{
    echo '<div id="primaryContent1">';
    if($_GET["action"] == "CSE"){
    $query = "SELECT * FROM faculty WHERE department='cse'";
    }
    if($_GET["action"] == "EE"){
        $query = "SELECT * FROM faculty WHERE department='ee'";
    }
    if($_GET["action"] == "ME"){
            $query = "SELECT * FROM faculty WHERE department='me'";
    }
    $res=mysqli_query($mySql_db,$query);
    $count=0;
    while($row = mysqli_fetch_assoc($res))
    {
        $count=1;
        echo '<div class="fac_row">
        <div class="fac_img">
        <img src="../image/images.jpg">
        </div>';     
        echo '<p> <a  href="http://localhost/practice/project/view_profile.php?action='.$row['email'].'">
                        <strong>'. $row['username'].'</strong></a>
                    <br>'. $row['department'].'
                    <br>'.$row['email'].'
                    <br>'.$row['role'].'
                    <br>'.$row['startDate'].'</p>
              </div>';
    }
    echo '</div>';
    if($count==0)
        echo '<p><strong>No faculty</strong><br></p>';
}

else if ($_GET["action"] == "showhierarchy") 
{
    echo '<div id="primaryContent1">';
    $query = "SELECT * FROM hierarchy";
    $res=mysqli_query($mySql_db,$query);
    $count=0;
    while($row = mysqli_fetch_assoc($res))
    {
        $count=1;
        echo '<div class="fac_row">';     
        echo '<p>   From: '. $row['From1'].'
                    <br>To: '. $row['To1'].'
            </p>
              </div>';
    }
    echo '</div>';
    if($count==0)
        echo '<p><strong>No hierarchy</strong><br></p>';
}


?>