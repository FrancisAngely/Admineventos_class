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
        <h1 class="h2">Eventos</h1>
           <a href="modulo_eventos_new.php" class="btn btn-primary">Nuevo</a>
      </div>
<!--SELECT `id`, `evento`, `fecha`, `file_evento`, `direccion`, `localidad`, `provincia`, `cp`, `hora_comienzo`, `created_at`, `updated_at` FROM `eventos` WHERE 1-->
      <table class="table datatabla">
          <thead>
    <tr>
        <th>Id</th> 
        <th>Role</th>
        <th>Fecha</th>
        <th>Localidad</th>
         <th>Provincia</th>
        <th>Acciones</th>
   </tr>
              </thead>
        <?php
        
          //$eventos=getAllV("eventos");
          $eventos=getAllVInner2("eventos","localidades","provincias","id_localidades","id_provincias","id","id");
        
         if(count($eventos)>0){
             foreach($eventos as $e){
                 ?>
          <tbody>
                    <tr>
                    <td><?php echo $e["id1"];?></td> 
                    <td><?php echo $e["evento"];?></td> 
                    <td><?php echo $e["fecha"];?></td> 
                     <td><?php echo $e["localidad"];?></td>   
                    <td><?php echo $e["provincia"];?></td>       

                    <td><a href="modulo_eventos_edit.php?id=<?php echo $e["id1"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                    &nbsp;&nbsp;
                     <a href="#" data-id="<?php echo $e["id1"];?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i></a>    
                    </td>
                    </tr>
                <?php
             }
         }
        ?>
        </tbody>  
    </table>

      
    </div> <!-- container -->

            </div> <!-- content -->

           
            <?php include("footer.php");?>
           

        </div>
    </div>
   
    <?php include("scripts.php");?>   
      <script>
        $(".borrar").click(function(){
            let id=$(this).attr('data-id');
            let padre=$(this).parent().parent();
           const swalWithBootstrapButtons = Swal.mixin({
                          customClass: {
                            confirmButton: "btn btn-success",
                            cancelButton: "btn btn-danger"
                          },
                          buttonsStyling: false
                        });
                        swalWithBootstrapButtons.fire({
                          title: "Desea eliminar el evento?",
                          text: "no hay vuelta atrás!",
                          icon: "warning",
                          showCancelButton: true,
                          confirmButtonText: "Si, borrar!",
                          cancelButtonText: "No, mantener!",
                          reverseButtons: true
                        }).then((result) => {
                          if (result.isConfirmed) {
                              
                              $.ajax({
                                     data:{id:id},
                                     method:"POST",
                                     url: "modulo_eventos_delete.php", 
                                     success: function(result){
                                         if(result==1){
                                            swalWithBootstrapButtons.fire({
                                              title: "Eliminado!",
                                              text: "Evento dado de baja",
                                              icon: "success"
                                            });
                                            padre.hide();
                                         }else{
                                             swalWithBootstrapButtons.fire({
                                              title: "No Eliminado!",
                                              text: "Evento NO dado de baja",
                                              icon: "error"
                                            });
                                         }
                                    }
                                 });

                              
                            
                              
                              
                          } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                          ) {
                         /*   swalWithBootstrapButtons.fire({
                              title: "Cancelled",
                              text: "Your imaginary file is safe :)",
                              icon: "error"
                            });*/
                          }
                        }); 
        });
        
        </script>
        <?php include("scriptsTabla.php");?>  
</body>
</html>