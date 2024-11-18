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
        <h1 class="h2">Participantes - Editar</h1>
           <a href="modulo_participantes_list.php" class="btn btn-primary">Volver</a>
      </div>

    <?php
        $part=getById("participantes",$_GET["id"]);
    ?>
        
    <div class="col-4">
    <form action="#" method="post" enctype="multipart/form-data" id="form1">
           <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $part["id"];?>"  >
        
        
        <div class="mb-3">
        <label for="id_eventos" class="form-label">Evento</label>
        <span id="id_eventos_error" class="text-danger"></span>
        <select class="form-control" id="id_eventos" name="id_eventos">
            <option></option>
            <?php //echo SelectOptionsId("roles","role");?>
             <?php echo SelectOptionsIdSel("eventos","evento",$part["id_eventos"]);?>
        </select>
        </div>
        
        <div class="mb-3">
        <label for="id_entradas" class="form-label">Entradas</label>
        <span id="id_entradas_error" class="text-danger"></span>
        <select class="form-control" id="id_entradas" name="id_entradas">
            <option></option>
            <?php //echo SelectOptionsId("roles","role");?>
              <?php echo SelectOptionsIdSelByColumn("entradas","entrada",$part["id_entradas"],"id_eventos",$part["id_eventos"]);?>
        </select>
        </div>
        
        <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <span id="nombre_error" class="text-danger"></span>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $part["nombre"];?>"  >
        </div>

        <div class="mb-3">
        <label for="apellidos" class="form-label">Apellidos</label>
        <span id="apellidos_error" class="text-danger"></span>
        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="apellidos" value="<?php echo $part["apellidos"];?>"  >
        </div>
        
        <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <span id="email_error" class="text-danger"></span>
        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="<?php echo $part["email"];?>"  >
        </div>
        
        <div class="mb-3">
        <label for="nif_nie" class="form-label">nif_nie</label>
        <span id="nif_nie_error" class="text-danger"></span>
        <input type="text" class="form-control" id="nif_nie" name="nif_nie" placeholder="nif_nie" value="<?php echo $part["nif_nie"];?>"  >
        </div>
        
    
        <div class="mb-3">
        <label for="telefono" class="form-label">telefono</label>
        <span id="telefono_error" class="text-danger"></span>
        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="telefono" value="<?php echo $part["telefono"];?>"  >
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
        
        //SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `participantes` WHERE 1
        
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
                 url: "modulo_participantes_update.php", 
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
                                location.href="modulo_participantes_list.php";
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
    
    $("#id_eventos").change(function(){
           let id_eventos= $("#id_eventos").val();
            $.ajax({
                 data:{id_eventos:id_eventos},
                 method:"POST",
                 url: "getEntradasEvento.php", 
                 success: function(result){
                    $("#id_entradas").html(result);
                     
                }
             });
       });
    
    
});      
      
</script>      
</body>
</html>