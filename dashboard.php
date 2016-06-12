<?php
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
  <script type="text/javascript">
$(function() {
    $('.date-picker').datepicker( {
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        dateFormat: 'MM yy',
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
    });
});
</script>
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
  <div class="col-sm-4"></div>
</div>
  <h3>Prescription issued</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="date" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="pres_sale" placeholder="Sale"></li>
      <input type="text" class="col-sm-3 form-control" id="pres_target" placeholder="Target"></li>
    <button type="submit" class="btn btn-default">Submit</button></div>
  </form>
  <h3>Prescription issued</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="date" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="_sale" placeholder="Sale">
      <input type="text" class="col-sm-3 form-control" id="_target" placeholder="Target">
    <button type="submit" class="btn btn-default">Submit</button></div>
  </form>
  <h3>Prescription issued</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="date" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="_sale" placeholder="Sale">
      <input type="text" class="col-sm-3 form-control" id="_target" placeholder="Target">
    <button type="submit" class="btn btn-default">Submit</button></div>
  </form>
  <h3>Prescription issued</h3>
  <form class="form-inline" role="form">
    <div class="form-group">
      <p3>Pick a Date: <input type="date"  id="date" class="date-picker" /></p3>
    </div> 
    <div class="form-group">
      <input type="text" class="col-sm-3 form-control" id="_sale" placeholder="Sale">
      <input type="text" class="col-sm-3 form-control" id="_target" placeholder="Target">
    <button type="submit" class="btn btn-default">Submit</button></div>
  </form>
</div>
</body>
</html>
