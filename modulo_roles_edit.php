<!DOCTYPE html>
<html lang="es" data-bs-theme="light" data-menu-color="light" data-topbar-color="dark">

<?php include("head.php");?>

<body>
    <div class="layout-wrapper">

        <?php include("leftsidebar.php");?>


        <div class="page-content">

          
           <?php include("topbar.php");?>
          
            <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                
                    <?php include("breadcrumb.php");?>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Roles - Editar</h1>
           <a href="modulo_roles_list.php" class="btn btn-primary">Volver</a>
      </div>

    <?php
        $role=getById("roles",$_GET["id"]);
    ?>
        
    <div class="col-4">
    <form action="#" method="post" enctype="multipart/form-data" id="form1">
           <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $role["id"];?>"  >
        
        <div class="mb-3">
        <label for="role" class="form-label">Role</label>
        <span id="role_error" class="text-danger"></span>
        <input type="text" class="form-control" id="role" name="role" placeholder="Role" value="<?php echo $role["role"];?>"  >
        </div>


       


        <div class="mb-3"> 
        <input type="button" class="form-control" value="Aceptar" id="btnform1">
        </div>

    </form>
 </div>    

      
  </div> <!-- container -->

            </div> <!-- content -->

           
            <?php include("footer.php");?>
           

        </div>
    </div>
   
    <?php include("scripts.php");?>   
      
      
<script>
$( document ).ready(function() {
   
    $("#btnform1").click(function(){
       // Swal.fire("SweetAlert2 is working!");
        
        //SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `roles` WHERE 1
        
            let role=$("#role").val();  
            let id=$("#id").val(); 
           let tabla="roles";  
            let campo="role";
            let error=0;
          
           if(role==""){    
               error=1;
               $("#role_error").html("Debe introduccir un role");
                $("#role").addClass("borderError");
           }
        
           
        if(error==0){
            
             $.ajax({
                 data:{valor:role,tabla:tabla,campo:campo,id:id},
                 method:"POST",
                 url: "verificarUnicoEdit.php", 
                 success: function(result){
                     if(result==0){
                        $("#role_error").html("role existe");
                        $("#role").val(''); 
                         $("#role").addClass("borderError");
                     }else{
                         $("#role").removeClass("borderError"); 
                         $("#role_error").html("");
                         //actualizar
                                $.ajax({
                 data:$("#form1").serialize(),
                 method:"POST",
                 url: "modulo_roles_update.php", 
                 success: function(result){
                    
                     if(result==1){
                         //alert("Datos insertados correctamente!");
                       let timerInterval;
                            Swal.fire({
                              title: "Datos actualizados correctamente!",
                              html: "",
                              timer: 2000,
                              timerProgressBar: true,
                              didOpen: () => {
                                Swal.showLoading();
                                const timer = Swal.getPopup().querySelector("b");
                                timerInterval = setInterval(() => {
                                  timer.textContent = `${Swal.getTimerLeft()}`;
                                }, 100);
                              },
                              willClose: () => {
                                clearInterval(timerInterval);
                              }
                            }).then((result) => {
                              /* Read more about handling dismissals below */
                              if (result.dismiss === Swal.DismissReason.timer) {
                                location.href="modulo_roles_list.php";
                              }
                            });
                          //location.href="clientes.php";
                     }else{
                          Swal.fire("No actualizados correctamente!");
                        
                     }
                }
             });
                     }
                 }
             });
            
        }
            
            
            
            
            
            
            
            
            
            
            
            
            //$("#form1").submit();
     
        
         
    });
    
   
    
    
});      
      
</script>      
</body>
</html>