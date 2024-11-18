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
        <h1 class="h2">Roles</h1>
           <a href="modulo_roles_new.php" class="btn btn-primary">Nuevo</a>
          &nbsp;&nbsp;
          <a href="#" class="btn btn-success" id="exportar">Exportar&nbsp;<i class="fa-regular fa-file-excel"></i></a>
          
          
          <a href="#" class="btn btn-success" id="exportar2">Exportar&nbsp;<i class="fa-regular fa-file-excel"></i></a>
      </div>
<?php
  $excel=' <table><thead><tr><th>Id</th> <th>Role</th></tr></thead><tbody>';                  
?>
      <table class="table" id="tabla">
          <thead>
    <tr>
        <th>Id</th> 
        <th>Role</th>
        <th>Acciones</th>
   </tr>
              </thead>
          <tbody>
        <?php
        
          $roles=getAllV("roles");
        
         if(count($roles)>0){
             foreach($roles as $r){
                 ?>
                    <tr>
                    <td><?php echo $r["id"];?></td> 
                    <td><?php echo $r["role"];?></td>  
                    <td><a href="modulo_roles_edit.php?id=<?php echo $r["id"];?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                    &nbsp;&nbsp;
                     <a href="#" data-id="<?php echo $r["id"];?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i>
                        
                <a href="modulo_roles_print.php?id=<?php echo $r["id"];?>"><i class="fa-solid fa-print"></i></a>
                    &nbsp;&nbsp;        
                </a>    
                    </td>
                    </tr>
                <?php
                 
                 $excel.='<tr>';
                 $excel.='<td>'.$r["id"].'</td>';
                 $excel.='<td>'.$r["role"].'</td>';
                 $excel.='</tr>';
             }
         }
        ?>
          </tbody>
          <tfooter>
    <tr>
        <th>Id</th> 
        <th>Role</th>
      <th>Acciones</th>
   </tr>
              </tfooter>
    </table>
<?php
  $excel.=' </tbody><tfooter><tr><th>Id</th><th>Role</th></tr></tfooter></table>';    

?>
      
     </div> <!-- content -->

           
            <?php include("footer.php");?>
           

        </div>
    </div>
   
   <form action="ficheroExcel.php" method="post" enctype="multipart/form-data" id="formExportar">
        <input type="hidden" value="Roles" name="nombreFichero">
        <input type="hidden" value="<?php echo $excel;?>" name="datos_a_enviar">
    </form>
        
    <?php include("scripts.php");?>      
      <script>
          $(document).ready(function() {
              
                $("#exportar").click(function(){
                 $("#formExportar").submit();
                });
              
              
              
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
                          title: "Desea eliminar el role?",
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
                                     url: "modulo_roles_delete.php", 
                                     success: function(result){
                                         if(result==1){
                                            swalWithBootstrapButtons.fire({
                                              title: "Eliminado!",
                                              text: "Rol dado de baja",
                                              icon: "success"
                                            });
                                            padre.hide();
                                         }else{
                                             swalWithBootstrapButtons.fire({
                                              title: "No Eliminado!",
                                              text: "Rol NO dado de baja",
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
       }); 
        </script>
      
</body>
</html>