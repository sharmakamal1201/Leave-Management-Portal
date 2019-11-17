<?php
    include("tool/functions.php");
    if(!isset($_SESSION['email'])){
      header("Location: check.php");
    } 
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link href='bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css' rel='stylesheet' type='text/css'>
    <script src='bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js' type='text/javascript'></script>
    <script type="text/javascript" src="lib/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker.css">
</head>

<body>
    <div class="container" style="margin-top:50px;">
        <div class="card">
            <h5 class="card-header">Apply for leave</h5>
            <div class="card-body">
                <form class="container">
                    <div class="form-group row">
                        <label for="leaveType" class="col-sm-2 col-form-label">Leave Type</label>
                        <div class="col-sm-4">
                            <select class="form-control" id="leaveType">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fromDate" class="col-sm-2 col-form-label">From Date</label>
                        <div class="dates col-sm-4" style="color:#2471a3;">
                            <input type="text" style="background-color:#aed6f1;" class="form-control usr1" id="fromDate" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="toDate" class="col-sm-2 col-form-label">To Date</label>
                        <div class="dates col-sm-4" style="color:#2471a3;">
                            <input type="text" style="background-color:#aed6f1;" class="form-control usr1" id="toDate" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="message" class="col-sm-2 col-form-label">Message</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" id="message" rows="5"></textarea>
                            <a href="#" class="btn btn-primary" id="submitleave" style="margin-top:15px;">Submit</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            $('.dates .usr1').datepicker({
                'format': 'yyyy-mm-dd',
                'autoclose': true
            });
        })


        $("#submitleave").click(function() {
            $.ajax({
                type: "POST",
                url: "action_apply_leave.php?action=apply",
                data: "leaveType=" + $("#leaveType").val() + "&fromDate=" + $("#fromDate").val() + "&toDate=" + $("#toDate").val() + "&message=" + $("#message").val(),
                success: function(result) {
                    alert(result);
                    if (result == 1) {
                       alert("Successfully Applied");
                    } else if(result == -11){
                        alert("Successfully applied but you have borrowed leave from future years");
                    }
                     else {
                        alert("Not Applied");
                    }
                }
            });
        });
    </script>

</body>

</html>