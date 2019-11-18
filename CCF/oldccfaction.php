<?php
include("../tool/functions.php");

if($_GET['action']=='oldcsehod' || $_GET['action']=='oldeehod' || $_GET['action']=='oldmehod'){
    $department = 'none';
    if($_GET['action']=='oldcsehod'){
        $department = 'cse';
    } else if($_GET['action']=='oldeehod'){
        $department = 'ee';
    }else if($_GET['action']=='oldmehod'){
        $department = 'me';
    }
    echo '<div id="primaryContent1"><div class="fac_row">';
    echo '<table class="table table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">EmailId</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Department</th>
            </tr>
        </thead>
        <tbody>';
    $query = "SELECT * FROM old_hod WHERE department='$department'";
    $res = mysqli_query($mySql_db, $query);
    while($row = mysqli_fetch_assoc($res)){
        $name = $row['name'];
        $email = $row['email'];
        $startDate = $row['startDate'];
        $endDate = $row['endDate'];
        echo '<tr><td>' . $name . '
        </td><td> ' . $email . '
        </td><td> ' . $startDate . '
        </td><td> ' . $endDate . '
        </td><td> ' . $department;
    }
    echo "</tbody></table></div></div>";
}
else if($_GET['action']=='oldAdeans' || $_GET['action']=='olddeans' || $_GET['action']=='olddirectors'){
    $query = "SELECT * FROM old_director";
    $var = 'director';
    if($_GET['action']=='oldAdeans'){
        $query = "SELECT * FROM old_Associatedean";
        $var = 'Assocdean';
    } else if($_GET['action']=='olddeans'){
        $query = "SELECT * FROM old_dean";
        $var = 'dean';
    } else if($_GET['action']=='olddirectors'){
        $query = "SELECT * FROM old_director";
        $var = 'director';
    }
    $res = mysqli_query($mySql_db, $query);
    echo '<div id="primaryContent1"><div class="fac_row">';
    echo '<table class="table table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">EmailId</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            </tr>
        </thead>
        <tbody>';
    while($row = mysqli_fetch_assoc($res)){
        $name = $row['name'];
        $email = $row['email'];
        $startDate = $row['startDate'];
        $endDate = $row['endDate'];
        echo '<tr><td>' . $name . '
        </td><td> ' . $email . '
        </td><td> ' . $startDate . '
        </td><td> ' . $endDate;
    }
    echo "</tbody></table></div></div>";
} else if ($_GET['action']=='currentfaculty'){
    $q = "SELECT * FROM faculty";
    $r = mysqli_query($mySql_db,$q);
    echo '<div id="primaryContent1"><div class="fac_row">';
    echo '<table class="table table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">EmailId</th>
            <th scope="col">Start Date</th>
            <th scope="col">Department</th>
            <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>';
    while($w = mysqli_fetch_assoc($r)){
        $name = $w['username'];
        $email = $w['email'];
        $startDate = $w['startDate'];
        $department = $w['department'];
        echo '<tr><td>' . $name . '
            </td><td> ' . $email . '
            </td><td> ' . $startDate . '
            </td><td> ' . $department.'
            </td><td> <a href="approveRecord.php?email='.$email.'&role=f">View</a>';
    }
    echo "</tbody></table></div></div>";
}  else if ($_GET['action']=='oldfaculty'){
    $q = "SELECT * FROM old_faculty";
    $r = mysqli_query($mySql_db,$q);
    echo '<div id="primaryContent1"><div class="fac_row">';
    echo '<table class="table table-hover table-sm">
        <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">EmailId</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date Date</th>
            <th scope="col">Department</th>
            <th scope="col">View</th>
            </tr>
        </thead>
        <tbody>';
    while($w = mysqli_fetch_assoc($r)){
        $name = $w['name'];
        $email = $w['email'];
        $startDate = $w['startDate'];
        $endDate = $w['endDate'];
        $department = $w['department'];
        echo '<tr><td>' . $name . '
            </td><td> ' . $email . '
            </td><td> ' . $startDate . '
            </td><td> ' . $endDate . '
            </td><td> ' . $department.'
            </td><td> <a href="approveRecord.php?email='.$email.'&role=f">View</a>';
    }
    echo "</tbody></table></div></div>";
} else {
    $email = $_GET['action'];
    $q = "SELECT * FROM faculty WHERE email='$email'";
    $r = mysqli_query($mySql_db,$q);
    $w = mysqli_fetch_assoc($r);
    $name = $w['username'];
    $startDate = $w['startDate'];
    $myTimeZone = date_default_timezone_set("Asia/kolkata");
    $endDate = date('Y-m-d H:i:s');
    $department = $w['department'];
    $q = "INSERT INTO old_faculty(name,email,startDate,endDate,department) VALUES('$name','$email','$startDate','$endDate','$department')";
    mysqli_query($mySql_db,$q);
    $q = "DELETE FROM faculty WHERE email='$email'";
    mysqli_query($mySql_db,$q);
    echo 1;
}

?>