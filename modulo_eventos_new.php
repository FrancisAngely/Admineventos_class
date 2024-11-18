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
        <h1 class="h2">Eventos - Nuevo</h1>
           <a href="modulo_eventos_list.php" class="btn btn-primary">Volver</a>
      </div>

    <div class="col-12">
    <form action="#" method="post" enctype="multipart/form-data" id="form1">
        <div class="col-4">
        <div class="mb-3">
            <label for="evento" class="form-label">Evento</label>
            <span id="evento_error" class="text-danger"></span>
            <input type="text" class="form-control" id="evento" name="evento" placeholder="Evento">
        </div>
        
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <span id="fecha_error" class="text-danger"></span>
            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Fecha">
        </div>
        
        <div class="mb-3">
            <label for="file_evento" class="form-label">Imagen</label>
            <span id="file_evento_error" class="text-danger"></span>
            <input type="file" class="form-control" id="file_evento" name="file_evento" >
        </div>

      
         <div class="mb-3">
            <label for="direccion" class="form-label">Dirección</label>
            <span id="direccion_error" class="text-danger"></span>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion">
        </div>
        
        
        
        
        <div class="mb-3">
        <label for="id_provincias" class="form-label">Provincia</label>
        <span id="id_provincias_error" class="text-danger"></span>
        <select class="form-control select2" id="id_provincias" name="id_provincias">
            <option></option>
            <?php //echo SelectOptionsId("roles","role");?>
            <?php echo SelectOptions("provincias","id","provincia");?>
        </select>
        </div>
        
        
        <div class="mb-3">
        <label for="id_localidades" class="form-label">Localidad</label>
        <span id="id_localidades_error" class="text-danger"></span>
        <select class="form-control select2" id="id_localidades" name="id_localidades">
            <option></option>
           
        </select>
        </div>
    
     
        
         
        
    
         <div class="mb-3">
            <label for="cp" class="form-label">C.P.</label>
            <span id="cp_error" class="text-danger"></span>
            <input type="text" class="form-control" id="cp" name="cp" placeholder="Código Postal">
        </div>
        
         <div class="mb-3">
            <label for="hora_comienzo" class="form-label">Hora</label>
            <span id="hora_comienzo_error" class="text-danger"></span>
            <input type="time" class="form-control" id="hora_comienzo" name="hora_comienzo" placeholder="Hora comienzo">
        </div>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Introduce una descripción"></textarea>
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
   
    tinymce.init({
  selector: '#descripcion',
        language: 'es',
  height: 500,
  plugins: [
    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
    'anchor', 'searchreplace', 'visualblocks', 'code',
    'insertdatetime', 'media', 'table', 'help', 'wordcount'
  ],
  toolbar: 'undo redo | blocks | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat ',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});
    
    
    $("#btnform1").click(function(){
       // Swal.fire("SweetAlert2 is working!");
        
        //SELECT `id`, `evento`, `fecha`, `file_evento`, `direccion`, `localidad`, `provincia`, `cp`, `hora_comienzo`, `created_at`, `updated_at` FROM `eventos` WHERE 1
        
         let evento=$("#evento").val();  
         let fecha=$("#fecha").val();  
         let direccion=$("#direccion").val();  
         let id_localidades=$("#id_localidades").val();  
         let id_provincias=$("#id_provincias").val();  
         let cp=$("#cp").val();  
         let hora_comienzo=$("#hora_comienzo").val();  
          let descripcion=tinyMCE.get('descripcion').getContent();
        let file_evento=$("#file_evento")[0].files[0];

        alert(descripcion);
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
           // var formData = new FormData($('#form1')[0]);
            
            var formData = new FormData();
            
         
            formData.append("evento", evento);
            formData.append("fecha", fecha);
            
            formData.append("file_evento", file_evento);
            
            formData.append("direccion", direccion);
            formData.append("id_provincias", id_provincias);
            formData.append("id_localidades", id_localidades);
            formData.append("cp", cp);
            formData.append("hora_comienzo", hora_comienzo);
            formData.append("descripcion", descripcion);
            
          $.ajax({
                data:formData,
                processData: false,
                contentType: false, 
                cache:false,
                method:"POST",
                url: "modulo_eventos_insert.php", 
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
                                location.href="modulo_eventos_list.php";
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