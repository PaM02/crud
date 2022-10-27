<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Bootstrap Multi Select Dropdown with Checkboxes using Jquery in PHP</title>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap3-typeahead.js"></script>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap-multiselect.js"></script>
  <link rel="stylesheet" href="css/bootstrap-multiselect.css" />
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:600px;">
   <h2 align="center">Bootstrap Multi Select Dropdown with Checkboxes using Jquery in PHP</h2>
   <br /><br />
   <form method="post" id="framework_form">
    <div class="form-group">
    
        <label align="center">
            <input type="text" id ="id" name="id" placeholder="Id" required="true"  /> 
         </label>
   
     <select id="framework" name="framework[]" multiple class="form-control" >
      <option value="Codeigniter">Codeigniter</option>
      <option value="CakePHP">CakePHP</option>
      <option value="Laravel">Laravel</option>
      <option value="YII">YII</option>
      <option value="Zend">Zend</option>
      <option value="Symfony">Symfony</option>
      <option value="Phalcon">Phalcon</option>
      <option value="Slim">Slim</option>
     </select>
    </div>
    <div class="form-group">
     <input type="submit" class="btn btn-info" name="submit" value="Submit" />
    </div>
   </form>
   <br />
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 $('#framework').multiselect({
  nonSelectedText: 'Menu',
  enableFiltering: true,
  enableCaseInsensitiveFiltering: true,
  buttonWidth:'400px'
 });
 
 $('#framework_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
   url:"insert.php",
   method:"POST",
   data:form_data,
   success:function(data)
   {
    $('#framework option:selected').each(function(){
     $(this).prop('selected', false);
    });
    $('#framework').multiselect('refresh');
    alert(data);
   }
  });
 });
 
 
});
</script>
