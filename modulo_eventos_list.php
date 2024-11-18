<!DOCTYPE html>
<html lang="es" data-bs-theme="light" data-menu-color="light" data-topbar-color="dark">

<?php include("head.php"); ?>

<body>
  <div class="layout-wrapper">

    <?php include("leftsidebar.php"); ?>


    <div class="page-content">


      <?php include("topbar.php"); ?>

      <div class="px-3">

        <!-- Start Content-->
        <div class="container-fluid">


          <?php include("breadcrumb.php"); ?>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Eventos</h1>
            <a href="modulo_eventos_new.php" class="btn btn-primary">Nuevo</a>
            &nbsp;&nbsp;
            <a href="#" class="btn btn-success" id="exportar">Exportar&nbsp;<i class="fa-regular fa-file-excel"></i></a>
          </div>

          <?php
          $excel = ' <table>
          <thead>
          <tr>
        <th>Id</th> 
        <th>Role</th>
        <th>Fecha</th>
        <th>Localidad</th>
         <th>Provincia</th>
          </tr>
          </thead>
          <tbody>';
          ?>

          <!--SELECT `id`, `evento`, `fecha`, `file_evento`, `direccion`, `localidad`, `provincia`, `cp`, `hora_comienzo`, `created_at`, `updated_at` FROM `eventos` WHERE 1-->

          <table class="table" id="tabla">
            <thead>
              <tr>
                <th>Id</th>
                <th>Evento</th>
                <th>Fecha</th>
                <th>Localidad</th>
                <th>Provincia</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <?php

            //$eventos=getAllV("eventos");
            $eventos = getAllVInner2("eventos", "localidades", "provincias", "id_localidades", "id_provincias", "id", "id");

            if (count($eventos) > 0) {
              foreach ($eventos as $e) {
            ?>
                <tbody>
                  <tr>
                    <td><?php echo $e["id1"]; ?></td>
                    <td><?php echo $e["evento"]; ?></td>
                    <td><?php echo $e["fecha"]; ?></td>
                    <td><?php echo $e["localidad"]; ?></td>
                    <td><?php echo $e["provincia"]; ?></td>

                    <td><a href="modulo_eventos_edit.php?id=<?php echo $e["id1"]; ?>"><i class="fa-solid fa-pen-to-square fa-2x"></i></a>
                      &nbsp;&nbsp;
                      <a href="#" data-id="<?php echo $e["id1"]; ?>" class="borrar"><i class="fa-solid fa-trash text-danger"></i></a>
                      <a href="modulo_eventos_print.php?id=<?php echo $e["id1"]; ?>"><i class="fa-solid fa-print"></i></a>

                    </td>
                  </tr>
              <?php
                $excel .= '<tr>';
                $excel .= '<td>' . $e["id1"] . '</td>';
                $excel .= '<td>' . $e["evento"] . '</td>';
                $excel .= '<td>' . $e["fecha"] . '</td>';
                $excel .= '<td>' . $e["localidad"] . '</td>';
                $excel .= '<td>' . $e["provincia"] . '</td>';
                $excel .= '</tr>';
              }
            }
              ?>
                </tbody>
          </table>

        </div> <!-- container -->

      </div> <!-- content -->


      <?php include("footer.php"); ?>


    </div>
  </div>
  <form action="ficheroExcel.php" method="post" enctype="multipart/form-data" id="formExportar">
    <input type="hidden" value="eventos" name="nombreFichero">
    <input type="hidden" value="<?php echo $excel; ?>" name="datos_a_enviar">
  </form>

  <?php include("scripts.php"); ?>

  <script>
    $(document).ready(function() {
      $("#exportar").click(function() {
        $("#formExportar").submit();
      });
      
      $(".borrar").click(function() {
        let id = $(this).attr('data-id');
        let padre = $(this).parent().parent();
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
              data: {
                id: id
              },
              method: "POST",
              url: "modulo_eventos_delete.php",
              success: function(result) {
                if (result == 1) {
                  swalWithBootstrapButtons.fire({
                    title: "Eliminado!",
                    text: "Evento dado de baja",
                    icon: "success"
                  });
                  padre.hide();
                } else {
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
          ) {}
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
  <?php include("scriptsTabla.php"); ?>
</body>

</html>