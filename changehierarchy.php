<?php
include("tool/header.php");
include("tool/functions.php");

$Fa = 0;
$Ho = 0;
$Ad = 0;
$De = 0;
$Di = 0;
$query = "SELECT * FROM hierarchy WHERE FROM1='faculty' or To1='faculty'";
$res = mysqli_query($mySql_db, $query);
if (mysqli_num_rows($res) == 0) {
    $Fa = 1;
} else {
    $Fa = 0;
}
$query = "SELECT * FROM hierarchy WHERE FROM1='hod' or To1='hod'";
$res = mysqli_query($mySql_db, $query);
if (mysqli_num_rows($res) == 0) {
    $Ho = 1;
} else {
    $Ho = 0;
}
$query = "SELECT * FROM hierarchy WHERE FROM1='associateDean' or To1='associatedean'";
$res = mysqli_query($mySql_db, $query);
if (mysqli_num_rows($res) == 0) {
    $Ad = 1;
} else {
    $Ad = 0;
}
$query = "SELECT * FROM hierarchy WHERE FROM1='deanfaa' or To1='deanfaaS'";
$res = mysqli_query($mySql_db, $query);
if (mysqli_num_rows($res) == 0) {
    $De = 1;
} else {
    $De = 0;
}
$query = "SELECT * FROM hierarchy WHERE From1='director' or To1='director'";
$res = mysqli_query($mySql_db, $query);
if (mysqli_num_rows($res) == 0) {
    $Di = 1;
} else {
    $Di = 0;
}

?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>



<table class="table table-hover table-sm">
    <thead>
        <tr>
            <th scope="col">Role</th>
            <th scope="col">Add/Remove</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Faculty</td>
            <td><button class="btn btn-primary" id="add_faculty" val="0"></button></td>
        </tr>
        <tr>
            <td>Hod</td>
            <td><button class="btn btn-primary" id="add_hod" val="0"></button></td>
        </tr>
        <tr>
            <td>Associate Dean</td>
            <td><button class="btn btn-primary" id="add_Adean" val="0"></button></td>
        </tr>
        <tr>
            <td>Dean</td>
            <td><button class="btn btn-primary" id="add_dean" val="0"></button></td>
        </tr>
        <tr>
            <td>Director</td>
            <td><button class="btn btn-primary" id="add_director" val="0"></button></td>
        </tr>
    </tbody>
</table>
<script>
    if ("<?php echo $Fa; ?>" == "1") {
        $("#add_faculty").html('Add');
        $("#add_faculty").val('1');
    } else {
        $("#add_faculty").html('Remove');
        $("#add_faculty").val('0');
    }
    if ("<?php echo $Ho; ?>" == "1") {
        $("#add_hod").html('Add');
        $("#add_hod").val('1');
    } else {
        $("#add_hod").html('Remove');
        $("#add_hod").val('0');
    }
    if ("<?php echo $Ad; ?>" == "1") {
        $("#add_Adean").html('Add');
        $("#add_Adean").val('1');
    } else {
        $("#add_Adean").html('Remove');
        $("#add_Adean").val('0');
    }
    if ("<?php echo $De; ?>" == "1") {
        $("#add_dean").html('Add');
        $("#add_dean").val('1');
    } else {
        $("#add_dean").html('Remove');
        $("#add_dean").val('0');
    }
    if ("<?php echo $Di; ?>" == "1") {
        $("#add_director").html('Add');
        $("#add_director").val('1');
    } else {
        $("#add_director").html('Remove');
        $("#add_director").val('0');
    }
    $(document).ready(function() {
        $(".btn").click(function() {
            if($(this).val()=="0"){
                $(this).val('1');
                $(this).html('Add');
            }
            else{
                $(this).val('0');
                $(this).html('Remove');
            }
            $.ajax({
                type: "POST",
                url: "actions.php?action=changehierarchy",
                data: "Fa="+$("#add_faculty").val()+"&Ho="+$("#add_hod").val()+"&Ad="+$("#add_Adean").val()+"&De="+$("#add_dean").val()+"&Di="+$("#add_director").val(),
                success: function(result) {
                    var val = " 1 ";
                }
            })
        });
    });
</script>