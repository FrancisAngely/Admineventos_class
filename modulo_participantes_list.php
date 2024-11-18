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
        <h1 class="h2">Participantes</h1>
           <a href="modulo_participantes_new.php" class="btn btn-primary">Nuevo</a>
      </div>

      <table class="table">
    <tr>
        <th>Id</th> 
        <th>Evento</th>
        <th>Entrada</th>  
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>E-mail</th>
        <th>Precio</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Acciones</th>
   </tr>
        <?php
        //  $participantes=TodosParticipantesV();
          $participantes=getAllVInner2("participantes","eventos","entradas","id_eventos","id_entradas","id","id");
            
         if(count($participantes)>0){
             foreach($participantes as $p){
                 ?>
                    <tr>
                    <td><?php echo $p["id1"];?></td> 
                     <td><?php echo $p["evento"];?></td>
                    <td><?php echo $p["entrada"];?></td>  
                    <td><?php echo $p["nombre"];?></td>
                         <td><?php echo $p["apellidos"];?></td>
                         <td><?php echo $p["email"];?></td>
                    <td><?php echo moneda($p["precio"]);?></td>
                    <td><?php echo cambiaf_a_espanol($p["fecha"]);?></td>
                         <td><?php echo substr($p["hora_comienzo"],0,5);?></td>
                    <td><a href="modulo_participantes_edit.php?id=<?php echo $p["id1"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                    &nbsp;&nbsp;
                     <a href="#" data-id="<?php echo $p["id1"];?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i></a>    
                    </td>
                    </tr>
                <?php
             }
         }
        ?>
          
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
                          title: "Desea eliminar el participante?",
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
                                     url: "modulo_participantes_delete.php", 
                                     success: function(result){
                                         if(result==1){
                                            swalWithBootstrapButtons.fire({
                                              title: "Eliminado!",
                                              text: "Participante dado de baja",
                                              icon: "success"
                                            });
                                            padre.hide();
                                         }else{
                                             swalWithBootstrapButtons.fire({
                                              title: "No Eliminado!",
                                              text: "Participante NO dado de baja",
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
      
</body>
</html>