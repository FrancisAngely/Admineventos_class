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

                
                    <?php include("breadcrumb.php");?>      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Usuarios</h1>
           <a href="modulo_usuarios_new.php" class="btn btn-primary">Nuevo</a>
      </div>

      <table class="table dt-responsive nowrap w-100" id="tabla">
          <thead>
    <tr>
        <th>Id</th> 
        <th>Usuario</th>  
        <th>E-mail</th>
        <th>Role</th>
        <th>Acciones</th>
   </tr>
              </thead>
        <?php
          //$usuarios=getAllV("usuarios");
          $usuarios=getAllVInner("usuarios","roles","id_roles","id");
         
         if(count($usuarios)>0){
             foreach($usuarios as $u){
                 ?>
          <tbody>
                    <tr>
                    <td><?php echo $u["id1"];?></td> 
                    <td><?php echo $u["usuario"];?></td>  
                    <td><?php echo $u["email"];?></td>
                    <td><?php echo $u["role"];?></td>
                    <td><a href="modulo_usuarios_edit.php?id=<?php echo $u["id1"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                    &nbsp;&nbsp;
                     <a href="#" data-id="<?php echo $u["id1"];?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i></a>    
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
                          title: "Desea eliminar al usuario?",
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
                                     url: "modulo_usuarios_delete.php", 
                                     success: function(result){
                                         if(result==1){
                                            swalWithBootstrapButtons.fire({
                                              title: "Eliminado!",
                                              text: "Usuario dado de baja",
                                              icon: "success"
                                            });
                                            padre.hide();
                                         }else{
                                             swalWithBootstrapButtons.fire({
                                              title: "No Eliminado!",
                                              text: "Usuario NO dado de baja",
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
          
          
          
           $("#tabla").DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                      previous: "<i class='mdi mdi-chevron-left'>",
                     next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function() {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            }
  
           });
        
        </script>
      
</body>

</html> 