
<script>            
      setTimeout ("window.location='logout.php'", 300000);          
</script> 
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="img/icon.png">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Gestion des profils</title>
  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="table/bootstrap-3.3.7/dist/css/bootstrap.css" />
  <link rel="stylesheet" href="table/bootstrap-3.3.7/dist/css/dataTables.bootstrap.min.css" />
   <link rel="stylesheet" href="css/bootstrap-multiselect.css" />

  <script src="table/js/jquery.min.js"></script>
  <script src="table/js/jquery.dataTables.js"></script>
  <script src="table/js/dataTables.bootstrap.min.js"></script>  
  <script src="table/js/bootstrap.min.js"></script>
  <script src="table/js/tabledit.js"></script>


  <script src="js/bootstrap3-typeahead.js"></script>  
  <script src="js/bootstrap-multiselect.js"></script>
 

  

  

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

     <?php
    include("sidebar.html"); 
    ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <?php
              include("topbar.php"); 
          ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

           <!--Page Heading -->
          <h1 align="center" class="h3 mb-2 text-gray-800">Gestion des profils</h1>
       
              <!-- DataTales Example -->
          <div >
              <br />
              <div class="panel panel-default">
                <div class="panel-heading">
                  <ul>
                          <li style="display: inline-block;">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addProfil">
                                <i class="fas fa-plus fa-sm fa-fw mr-2 text-gray-400"></i>
                                      Nouveau profil
                            </a>
                          </li>
                      </ul>
              </div>
              <?php
                          if(isset($_GET['succes'])){

                            $succes = $_GET['succes'];
                            if($succes==0){
                                echo "<p style='color:red;text-align: center;'>Mot de passe incorrect</p>";
                            }
                            elseif ($succes==1) {
                              echo "<p style='color:green;text-align: center;'>votre nouveau compte a été enregistré avec succès</p>";
                            }
                        }
                    ?>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table id="sample_data" class="table  table-bordered table-striped" width="100%" cellspacing="0" >
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>menu</th>
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>
                 </div>
            </div>
           </div>
          </div>
          <br />
          <br />
          <!--End of DataTales Example -->    
        </div>
        <!-- End of Page Content -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; CISIX Sarl 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

    <!-- Logout Modal-->
  <?php
      include("logoutModal.html"); 
  ?>
  <?php
    include("addProfil.php"); 
    ?>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>


  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>



</body>
</html>
<script type="text/javascript" language="javascript" >
	$(document).ready(function(){
   

			var dataTable = $('#sample_data').DataTable({

          
					"processing" : true,
					"serverSide" : true,
					"order" : [],
					"ajax" :{

							url:"php/gestionDesProfils/fetch.php",
							type:"POST"
					}
			});

			$('#sample_data').on('draw.dt', function(){

				$('#sample_data').Tabledit({

					url:'php/gestionDesProfils/action.php',
					dataType:'json',

					columns:{
						identifier : [0, 'id'],

						editable:[
            [1, 'menu']
						]
					},
					restoreButton:false,
					onSuccess:function(data, textStatus, jqXHR){

						if(data.action == 'delete'){

							$('#' + data.id).remove();
							$('#sample_data').DataTable().ajax.reload();
						}
					}
				});
			});


      $('#menu').multiselect({
        nonSelectedText: 'Menu',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth:'400px'
       });
       
       $('#menu_form').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
         url:"php/insertProfil.php",
         method:"POST",
         data:form_data,
         success:function(data){
          $('#menu option:selected').each(function(){
           $(this).prop('selected', false);
          });
          $('#menu').multiselect('refresh');
          $('#addProfil').modal('hide');  
          $('#sample_data').DataTable().ajax.reload();
         }
        });
       });
		  
		}); 
</script>



