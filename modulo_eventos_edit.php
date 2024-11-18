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
        <h1 class="h2">Eventos - Editar</h1>
           <a href="modulo_eventos_list.php" class="btn btn-primary">Volver</a>
      </div>

    <?php
        $evento=getById("eventos",$_GET["id"]);
    ?>
        
    <div class="col-4">
    <form action="#" method="post" enctype="multipart/form-data" id="form1">
           <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $evento["id"];?>"  >
        
        <div class="mb-3">
        <label for="evento" class="form-label">Evento</label>
        <span id="evento_error" class="text-danger"></span>
        <input type="text" class="form-control" id="evento" name="evento" placeholder="Evento" value="<?php echo $evento["evento"];?>"  >
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <span id="fecha_error" class="text-danger"></span>
            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha" value="<?php echo $evento["fecha"];?>"  >
        </div>
        
        <div class="mb-3">
            <label for="file_evento" class="form-label">Imagen</label>
            <span id="file_evento_error" class="text-danger"></span>
            <img src="<?php echo $evento["file_evento"];?>" class="img-fluid">
            <input type="file" class="form-control" id="file_evento" name="file_evento" >
        </div>

      
         <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <span id="direccion_error" class="text-danger"></span>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo $evento["direccion"];?>"  >
        </div>
        
        
        
        
        <div class="mb-3">
        <label for="id_provincias" class="form-label">Provincia</label>
        <span id="id_provincias_error" class="text-danger"></span>
        <select class="form-control" id="id_provincias" name="id_provincias">
            <option></option>
            <?php //echo SelectOptionsId("roles","role");?>
             <?php echo SelectOptionsIdSel("provincias","provincia",$evento["id_provincias"]);?>
        </select>
        </div>
        
        <div class="mb-3">
        <label for="id_localidades" class="form-label">Localidad</label>
        <span id="id_localidades_error" class="text-danger"></span>
        <select class="form-control" id="id_localidades" name="id_localidades">
            <option></option>
            <?php //echo SelectOptionsId("roles","role");?>
              <?php echo SelectOptionsIdSelByColumn("localidades","localidad",$evento["id_localidades"],"id_provincias",$evento["id_provincias"]);?>
        </select>
        </div>
        
        
        
      
        
    
         <div class="mb-3">
            <label for="cp" class="form-label">C.P.</label>
            <span id="cp_error" class="text-danger"></span>
            <input type="text" class="form-control" id="cp" name="cp" placeholder="Código Postal" value="<?php echo $evento["cp"];?>"  >
        </div>
        
         <div class="mb-3">
            <label for="hora_comienzo" class="form-label">Hora</label>
            <span id="hora_comienzo_error" class="text-danger"></span>
            <input type="time" class="form-control" id="hora_comienzo" name="hora_comienzo" placeholder="Hora comienzo" value="<?php echo $evento["hora_comienzo"];?>"  >
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
        
        //SELECT `id`, `id_eventos`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `eventos` WHERE 1
         let evento=$("#evento").val();  
         let fecha=$("#fecha").val();  
         let direccion=$("#direccion").val();  
         let id_localidades=$("#id_localidades").val();  
         let id_provincias=$("#id_provincias").val();  
         let cp=$("#cp").val();  
         let hora_comienzo=$("#hora_comienzo").val();  
         let error=0;
          
          if(evento==""){    
               error=1;
               $("#evento_error").html("Debe introduccir un evento");
                $("#evento").addClass("borderError");
           }
        
          if(fecha==""){    
               error=1;
               $("#fecha_error").html("Debe introduccir una fecha");
                $("#fecha").addClass("borderError");
           }
        
            if(direccion==""){    
               error=1;
               $("#direccion_error").html("Debe introduccir una direccion");
                $("#direccion").addClass("borderError");
           }
            if(id_localidades==""){    
                   error=1;
                   $("#id_localidades_error").html("Debe introduccir una localidad");
                    $("#id_localidades").addClass("borderError");
               }
            if(id_provincias==""){    
                   error=1;
                   $("#id_provincias_error").html("Debe introduccir una provincia");
                    $("#id_provincias").addClass("borderError");
               }
            if(cp==""){    
                   error=1;
                   $("#cp_error").html("Debe introduccir un cp");
                    $("#cp").addClass("borderError");
               }
            if(hora_comienzo==""){    
                   error=1;
                   $("#hora_comienzo_error").html("Debe introduccir un evento");
                    $("#hora_comienzo").addClass("borderError");
               }
           
        if(error==0){
              var formData = new FormData($('#form1')[0]);
          
            $.ajax({
                 data:formData,
                 processData: false,
                contentType: false, 
                cache:false,
                 method:"POST",
                 url: "modulo_eventos_update.php", 
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
                                location.href="modulo_eventos_list.php";
                              }
                            });
                          //location.href="clientes.php";
                     }else{
                          Swal.fire("No actualizados correctamente!");
                        
                     }
                }
             });
                     
            
        }
            
    
         
    });
    
   
    $("#id_provincias").change(function(){
           let id_provincias= $("#id_provincias").val();
            $.ajax({
                 data:{id_provincias:id_provincias},
                 method:"POST",
                 url: "getLocalidadesProvincia.php", 
                 success: function(result){
                    $("#id_localidades").html(result);
                     
                }
             });
       }); 
    
});      
      
</script>      
</body>
</html>