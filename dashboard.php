<?php
if(!$_SESSION['login']){
   header("location:login.php");
   die;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<style>
.ui-datepicker-calendar {
    display: none;
    }
</style>
  </script>
</head>
<body>
<div class="container">
  <div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4">Logo</div>
  <div class="col-sm-4"><button id="stats" type="button" class="btn btn-default" onclick="window.location.href='statistics.php'">Statistics</button></div>
</div>
  <h3>Prescriptions issued</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="prescriptionDate" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="prescriptionSales" placeholder="Sales"></li>
      <input type="text" class="col-sm-3 form-control" id="priscriptionTarget" placeholder="Target"></li>
    <button id="prescription" type="button" class="btn btn-default">Submit</button>
  </div>
  </form>
  <h3>Clinical income</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="date" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="_sale" placeholder="Sales">
      <input type="text" class="col-sm-3 form-control" id="_target" placeholder="Target">
    <button type="button" class="btn btn-default">Submit</button></div>
  </form>
  <h3>MUR</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="MURDate" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="MURSale" placeholder="Sales">
      <input type="text" class="col-sm-3 form-control" id="MURTarget" placeholder="Target">
    <button type="button" class="btn btn-default">Submit</button></div>
  </form>
  <h3>NMS</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="date" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="_sale" placeholder="Sales">
      <input type="text" class="col-sm-3 form-control" id="_target" placeholder="Target">
    <button type="button" class="btn btn-default">Submit</button></div>
  </form>
  <h3>Retail</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="date" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="_sale" placeholder="Sales">
      <input type="text" class="col-sm-3 form-control" id="_target" placeholder="Target">
    <button type="button" class="btn btn-default">Submit</button></div>
  </form>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $(function() {
    $('.date-picker').datepicker({
        showOtherMonths: false,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
  });
  $('button[type ="button"]').click(function(){
    console.log(this.id);
    var clientId = <?php echo json_encode($_SESSION['id']); ?>;
    var saleType = this.id;
    var formData = {
            'date'      : $('#'+saleType+'Date').val(),
            'sales'      : $('#'+saleType+'Sales').val(),
            'target'    : $('#'+saleType+'Target').val(),
            'client'    : 100001
        };
     $.ajax({
                type: 'POST',
                url: saleType+'.php',
                data: formData,
                success: function(data) {
                    alert("Data saved");
                }
            });
  });
});
</script>
</body>
</html>
