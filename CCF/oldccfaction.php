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
        </td><td> ' . $department ;
    }
    echo "</tbody></table></div></div>";
}
else if($_GET['action']=='oldAdeans' || $_GET['action']=='olddeans' || $_GET['action']=='olddirectors'){
    $query = "SELECT * FROM old_director";
    if($_GET['action']=='oldAdeans'){
        $query = "SELECT * FROM old_Associatedean";
    } else if($_GET['action']=='olddeans'){
        $query = "SELECT * FROM old_dean";
    } else if($_GET['action']=='olddirectors'){
        $query = "SELECT * FROM old_director";
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
}

?>