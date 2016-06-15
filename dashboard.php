<?php
echo $_SESSION[id]."logged in";
/*if(!$_SESSION['login']){
   header("location:login.php");
   die;
}*/
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
  <div class="col-sm-4"><input id="stats" value='Statistics' type="button" class="btn btn-default" onclick="window.location.href='statistics.php'"></div>
</div>
  <h3>Prescriptions issued</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="prescriptions_issuedDate" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="prescriptions_issuedSales" placeholder="Sales"></li>
      <input type="text" class="col-sm-3 form-control" id="prescriptions_issuedTarget" placeholder="Target"></li>
    <button id="prescriptions_issued" type="button" class="btn btn-default">Submit</button>
  </div>
  </form>
  <h3>Clinical income</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="clinical_incomeDate" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="clinical_incomeSales" placeholder="Sales">
      <input type="text" class="col-sm-3 form-control" id="clinical_incomeTarget" placeholder="Target">
    <button type="button" class="btn btn-default" id="clinical_income">Submit</button></div>
  </form>
  <h3>MUR</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="MURDate" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="MURSales" placeholder="Sales">
      <input type="text" class="col-sm-3 form-control" id="MURTarget" placeholder="Target">
    <button type="button" class="btn btn-default" id="MUR">Submit</button></div>
  </form>
  <h3>NMS</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="NMSDate" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="NMSSales" placeholder="Sales">
      <input type="text" class="col-sm-3 form-control" id="NMSTarget" placeholder="Target">
    <button type="button" class="btn btn-default" id="NMS">Submit</button></div>
  </form>
  <h3>Retail</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="retailDate" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="retailSales" placeholder="Sales">
      <input type="text" class="col-sm-3 form-control" id="retailTarget" placeholder="Target">
    <button type="button" class="btn btn-default" id="retail">Submit</button></div>
  </form>
</div>
<script type="text/javascript">
function prepopulate (data) {
  if (validate(data)) {
    for (var i = 0; i < data.length; i++) {
      $('#'+data[i].name+'Target').val(data[i].sales_target).css('background-color','#eee');
    };
  };
}
function validate (data) {
  data=JSON.stringify(data);
  return true;
}
$(document).ready(function(){
  var today = new Date().toISOString().substring(0, 10);
  var minDay =new Date()
  minDay.setDate(1);
  $('input[type="date"]').attr({min:minDay.toISOString().substring(0, 10),max:today});

  var formData = {
      'client'    : 100001,
      'label'     :'getMonthlyTargetOfAllSalesTypeOfClient'
    };
  $.ajax({
      type: 'POST',
      url: 'model/targetDao.php',
      data: formData,
      success: function(data) {
        data =JSON.parse(data);
        prepopulate(data);
      }
  });

  $('button[type ="button"]').click(function(){
    var clientId = <?php echo json_encode($_SESSION['id']); ?>;
    var salesType = this.id;
    var formData = {
      'date'      : $('#'+salesType+'Date').val(),
      'sales'      : $('#'+salesType+'Sales').val(),
      'target'    : $('#'+salesType+'Target').val(),
      'client'    : 100001,
      'salesType' : salesType
    };
    $.ajax({
      type: 'POST',
      url: 'sales.php',
      data: formData,
      success: function(data) {
        alert(data);
      }
    });
  });
});
</script>
</body>
</html>
