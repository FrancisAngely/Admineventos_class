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
        <h1 class="h2">Entradas - Nuevo</h1>
           <a href="modulo_entradas_list.php" class="btn btn-primary">Volver</a>
      </div>

    <div class="col-4">
    <form action="#" method="post" enctype="multipart/form-data" id="form1">
        <div class="mb-3">
        <label for="entrada" class="form-label">Entrada</label>
        <span id="entrada_error" class="text-danger"></span>
        <input type="text" class="form-control" id="entrada" name="entrada" placeholder="Entrada">
        </div>

        <div class="mb-3">
        <label for="id_eventos" class="form-label">Evento</label>
        <span id="id_eventos_error" class="text-danger"></span>
        <select class="form-control" id="id_eventos" name="id_eventos">
            <option></option>
            <?php //echo SelectOptionsId("roles","role");?>
            <?php echo SelectOptions("eventos","id","evento");?>
        </select>
        </div>
       
        
        
        <div class="mb-3">
        <label for="precio" class="form-label">Precio</label>
        <span id="precio_error" class="text-danger"></span>
        <input type="number" class="form-control" id="precio" name="precio" step="0.01" min=0>
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
        
        //SELECT `id`, `entrada`, `id_eventos`, `precio`, `created_at`, `updated_at` FROM `entradas` WHERE 1
        
            let entrada=$("#entrada").val();  
            let id_eventos=$("#id_eventos").val();
            let precio=$("#precio").val();
          
            let error=0;
          
           if(entrada==""){    
               error=1;
               $("#entrada_error").html("Debe introducir un nombre de entrada");
                $("#entrada").addClass("borderError");
           }
        
           if(id_eventos==""){ 
               error=1;
               $("#id_eventos_error").html("Debe seleccionar un evento");
               $("#id_eventos").addClass("borderError");
           }
        
        if(precio==""){ 
               error=1;
               $("#precio_error").html("Debe introducir un precio");
               $("#precio").addClass("borderError");
           }
        
        
        if(error==0){
            //$("#form1").submit();
             $.ajax({
                 data:$("#form1").serialize(),
                 method:"POST",
                 url: "modulo_entradas_insert.php", 
                 success: function(result){
                    
                     if(result>=1){
                         //alert("Datos insertados correctamente!");
                       let timerInterval;
                            Swal.fire({
                              title: "Datos insertados correctamente!",
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
                                location.href="modulo_entradas_list.php";
                              }
                            });
                          //location.href="clientes.php";
                     }else{
                          Swal.fire("No Insertado correctamente!");
                        
                     }
                }
             });
        }
         
    });
    
   
    
    
});      
      
</script>      
</body>
</html>