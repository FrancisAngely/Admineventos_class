<?php

//verifica si el usuario y la contraseña encriptada en MD5 existe en la tabla usuarios
function VerificarUsuario($username, $passMd5)
{
    include("db.php");
    $sql = "SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `usuarios`";
    $sql .= " WHERE 1 ";
    $sql .= " and `usuario`='" . $username . "'";
    $sql .= " and `password`='" . $passMd5 . "'";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        //usuario valido
        $fila = $query->fetch_assoc();
        return $fila;
    } else {
        return 0;
    }
}

//obtiene un registro de la tabla donde coinciden dos valores de busqueda
function getByColum2($tabla, $column1, $valor1, $column2, $valor2)
{
    include("db.php");
    $sql = "SELECT * FROM `" . $tabla . "`";
    $sql .= " WHERE 1 ";
    $sql .= " and `" . $column1 . "`='" . $valor1 . "'";
    $sql .= " and `" . $column2 . "`='" . $valor2 . "'";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        //usuario valido
        $fila = $query->fetch_assoc();
        return $fila;
    } else {
        return 0;
    }
}

//obtiene un registro de la tabla donde coincide un valor
function getByColum($tabla, $column1, $valor1)
{
    include("db.php");
    $sql = "SELECT * FROM `" . $tabla . "`";
    $sql .= " WHERE 1 ";
    $sql .= " and `" . $column1 . "`='" . $valor1 . "'";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        //usuario valido
        $fila = $query->fetch_assoc();
        return $fila;
    } else {
        return 0;
    }
}

//obtiene TODOS registros de una tabla filtrado por un campo (devuelve QUERY)
function getAllByColumn($tabla, $column1, $valor1)
{
    include("db.php");
    $sql = "SELECT * FROM `" . $tabla . "` ";
    $sql .= " WHERE 1 ";
    $sql .= " and `" . $column1 . "`='" . $valor1 . "'";

    $query = $mysqli->query($sql);

    return $query;
}

//obtiene TODOS registros de una tabla (devuelve QUERY)
function getAll($tabla)
{
    include("db.php");
    $sql = "SELECT * FROM `" . $tabla . "` WHERE 1";

    $query = $mysqli->query($sql);

    return $query;
}


//obtiene TODOS registros de una tabla (devuelve VECTOR ASOCIATIVO)
function getAllV($tabla)
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT * FROM `" . $tabla . "` WHERE 1";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}

//obtiene TODOS registros de DOS tablas unidas por un indice (devuelve VECTOR ASOCIATIVO)
//PK de la tabla principal es id1 en el vector

function getAllVInner($tabla1, $tabla2, $id1, $id2)
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT `" . $tabla1 . "`.*,`" . $tabla2 . "`.*, `" . $tabla1 . "`.id as id1 FROM `" . $tabla1 . "` ";
    $sql .= " INNER JOIN `" . $tabla2 . "` ON `" . $tabla1 . "`.`" . $id1 . "`=`" . $tabla2 . "`.`" . $id2 . "`";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}


//obtiene TODOS registros de TRES tablas inner join(devuelve VECTOR ASOCIATIVO)
//$tabla_1_id_tabla_2 campo de la tabla 1 que es igual al $id_tabla2 de la tabla2
//$tabla_1_id_tabla_3 campo de la tabla 1 que es igual al $id_tabla3 de la tabla3
//PK de la tabla principal es id1 en el vector
function getAllVInner2($tabla1, $tabla2, $tabla3, $tabla_1_id_tabla_2, $tabla_1_id_tabla_3, $id_tabla2, $id_tabla3)
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT `" . $tabla1 . "`.*,`" . $tabla2 . "`.*,`" . $tabla3 . "`.*, `" . $tabla1 . "`.id as id1 FROM `" . $tabla1 . "` ";
    $sql .= " INNER JOIN `" . $tabla2 . "` ON `" . $tabla1 . "`.`" . $tabla_1_id_tabla_2 . "`=`" . $tabla2 . "`.`" . $id_tabla2 . "`";

    $sql .= " INNER JOIN `" . $tabla3 . "` ON `" . $tabla1 . "`.`" . $tabla_1_id_tabla_3 . "`=`" . $tabla3 . "`.`" . $id_tabla3 . "`";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}


//consigue un registro de la tabla por ID
function getById($tabla, $id)
{
    include("db.php");
    $fila = array();
    $sql = "SELECT * FROM `" . $tabla . "` WHERE `id`=" . $id;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        $fila = $query->fetch_assoc();
    }
    return $fila;
}


//borra un registro de la tabla por ID
function delById($tabla, $id)
{
    include("db.php");
    $sql = "DELETE FROM `" . $tabla . "` WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}

//guarda los valores de una tabla
//$campos es un string con todos los nombres de los campos de la tabla separado por comas.
// obligatorio todos los campos que no admiten Nulo
//$valores = string con todos los valores ordenados igual con los campos y los valores que
// no sean INT tienen que ir con ''
function save($tabla, $campos, $valores)
{

    include("db.php");
    $sql = "INSERT INTO `" . $tabla . "`(" . $campos . ") VALUES (";
    $sql .= $valores;
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}

//guarda los valores de una tabla
//$datos: vector asociativo minimo con todos los campos que no admiten nulo
// el nombre de los campos son los indices del vector ($k)
// el valor son el contenido de las posiciones del vector ($v)
function saveV($tabla, $datos)
{

    include("db.php");
    $sql = "INSERT INTO `" . $tabla . "`(";

    $aux = 0;
    foreach ($datos as $k => $v) {
        if ($aux == 0) {
            $sql .= "`" . $k . "`";
            $aux++;
        } else {
            $sql .= ",`" . $k . "`";
        }
    }
    $sql .= ")";
    $sql .= "VALUES (";
    $aux = 0;
    foreach ($datos as $k => $v) {
        if ($aux == 0) {
            $sql .= "'" . $v . "'";
            $aux++;
        } else {
            $sql .= ",'" . $v . "'";
        }
    }
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}

//guarda los valores de una tabla (igual que la función saveV)
//$datos: vector asociativo minimo con todos los campos que no admiten nulo
// el nombre de los campos son los indices del vector ($k)
// el valor son el contenido de las posiciones del vector ($v)
function saveV2($tabla, $datos)
{

    include("db.php");

    $campos = "";
    $valores = "";
    $aux = 0;
    foreach ($datos as $k => $v) {
        if ($aux == 0) {
            $campos .= "`" . $k . "`";
            $valores .= "'" . $v . "'";
            $aux++;
        } else {
            $campos .= ",`" . $k . "`";
            $valores .= ",`" . $v . "`";
        }
    }

    $sql = "INSERT INTO `" . $tabla . "`(";
    $sql .= $campos;
    $sql .= ")";
    $sql .= "VALUES (";
    $sql .= $valores;
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}

//guarda los valores de una tabla (igual que la función saveV y saveV2 para la conexión PDO)
//$datos: vector asociativo minimo con todos los campos que no admiten nulo
// el nombre de los campos son los indices del vector ($k)
// el valor son el contenido de las posiciones del vector ($v)
function savePDO($tabla, $datos)
{

    include("db.php");
    $campos = "";
    $valoresIn = "";
    $aux = 0;
    $in = array();
    foreach ($datos as $k => $v) {
        array_push($in, $v);
        if ($aux == 0) {
            $campos .= $k;
            $valoresIn .= "?";
            $aux++;
        } else {
            $campos .= "," . $k;
            $valoresIn .= ",?";
        }
    }
    $stmt = $dbh->prepare("INSERT INTO " . $tabla . "(" . $campos . ") VALUES (" . $valoresIn . ")");

    $stmt->execute($in);
    echo 1;
}

//actualiza los datos del registro de una tabla por ID
//$datos: vector asociativo con los datos que queremos actualizar
// el nombre de los campos son los indices del vector ($k)
// el valor son el contenido de las posiciones del vector ($v)

function updateById($tabla, $datos, $id)
{
    include("db.php");
    $sql = "UPDATE `" . $tabla . "` SET  ";
    $aux = 0;
    foreach ($datos as $k => $v) {
        if ($aux == 0) {
            $sql .= "`" . $k . "`='" . $v . "'";
            $aux++;
        } else {
            $sql .= ",`" . $k . "`='" . $v . "'";
        }
    }
    $sql .= " WHERE `id`='" . $id . "'";

    if ($mysqli->query($sql)) return 1;
    else return 0;
}

//devuelve una query con todos los registros de la tabla clientes
function TodosClientes()
{
    include("db.php");
    $sql = "SELECT `id`, `nombre`, `apellidos`, `created_at`, `updated_at` FROM `clientes` WHERE 1";

    $query = $mysqli->query($sql);

    return $query;
}
//devuelve un vector asociativo con todos los registros de la tabla participantes
//con el nombre del evento, el nombre de la entrada y precio.
//(inner join con eventos y entradas)
function TodosParticipantesV()
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT `participantes`.`id` as id1, `participantes`.`id_eventos`, `participantes`.`id_entradas`, `participantes`.`nombre`, `participantes`.`apellidos`, `participantes`.`email`, `participantes`.`nif_nie`, `participantes`.`telefono`, `participantes`.`created_at`, `participantes`.`updated_at`,eventos.evento,entradas.entrada,entradas.precio FROM `participantes` ";
    $sql .= " INNER JOIN eventos ON `participantes`.`id_eventos`=eventos.id";
    $sql .= " INNER JOIN entradas ON `participantes`.`id_entradas`=entradas.id";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}


//devuelve un vector asociativo con todos los registros de la tabla clientes
function TodosClientesV()
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT `id`, `nombre`, `apellidos`, `created_at`, `updated_at` FROM `clientes` WHERE 1";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}

//elimina un registro de la tabla clientes por ID
function EliminarCliente($id)
{
    include("db.php");
    $sql = "DELETE FROM `clientes` WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}


//inserta los valores enviados pòr POST en la tabla clientes
//$post es $_POST
function InsertarCliente($post)
{
    $nombre = $post["nombre"];
    $apellidos = $post["apellidos"];
    include("db.php");
    $sql = "INSERT INTO `clientes`(`id`, `nombre`, `apellidos`, `created_at`, `updated_at`) VALUES (";
    $sql .= "'NULL'";
    $sql .= ",'" . $nombre . "'";
    $sql .= ",'" . $apellidos . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ")";

    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}

//actualiza un registro con los valores enviados pòr POST en la tabla clientes
//$post es $_POST
function ActualizarCliente($post)
{
    $id = $post["id"];
    $nombre = $post["nombre"];
    $apellidos = $post["apellidos"];

    include("db.php");
    $sql = "UPDATE `clientes` SET `nombre`='" . $nombre . "',`apellidos`='" . $apellidos . "',`updated_at`='" . date("Y-m-d h:i:s") . "' WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}


//devuelve una query con todos los registros de la tabla proveedores
function TodosProveedores()
{
    include("db.php");
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";

    $query = $mysqli->query($sql);

    return $query;
}

//devuelve un vector asociativo con todos los registros de la tabla proveedores
function TodosProveedoresV()
{
    include("db.php");
    $resultado = array();
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            array_push($resultado, $fila);
        }
    }
    return $resultado;
}

//elimina un proveedor por Id
function EliminarProveedor($id)
{
    include("db.php");
    $sql = "DELETE FROM `proveedores` WHERE `id`='" . $id . "'";


    if ($mysqli->query($sql)) return 1;
    else return 0;
}

//inserta los valores enviados pòr POST en la tabla proveedores
//$post es $_POST
function InsertarProveedor($post)
{
    $razon_social = $post["razon_social"];
    $nombre_comercial = $post["nombre_comercial"];
    $cif = $post["cif"];
    $formapago = $post["formapago"];
    include("db.php");
    $sql = "INSERT INTO `proveedores`(`id`, `razon_social`, `nombre_comercial`,`cif`,`formapago`, `created_at`, `updated_at`) VALUES (";
    $sql .= "'NULL'";
    $sql .= ",'" . $razon_social . "'";
    $sql .= ",'" . $nombre_comercial . "'";
    $sql .= ",'" . $cif . "'";
    $sql .= ",'" . $formapago . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ",'" . date("Y-m-d h:i:s") . "'";
    $sql .= ")";
    if ($mysqli->query($sql)) return $mysqli->insert_id;
    else return 0;
}

//actualiza un registro con los valores enviados pòr POST en la tabla proveedores
//$post es $_POST
function ActualizarProveedor($post)
{
    $id = $post["id"];
    $razon_social = $post["razon_social"];
    $nombre_comercial = $post["nombre_comercial"];
    $cif = $post["cif"];
    $formapago = $post["formapago"];

    include("db.php");
    $sql = "UPDATE `proveedores` SET `razon_social`='" . $razon_social . "',`nombre_comercial`='" . $nombre_comercial . "',`cif`='" . $cif . "',`formapago`='" . $formapago . "',`updated_at`='" . date("Y-m-d h:i:s") . "' WHERE `id`='" . $id . "'";



    if ($mysqli->query($sql)) return 1;
    else return 0;
}

//devuelve un registro de la tabla proveedores donde id se lo paso como argumento
function DatosProveedor($id)
{
    include("db.php");
    $fila = array();
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE `id`=" . $_GET["id"];
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        $fila = $query->fetch_assoc();
    }
    return $fila;
}

//devuelve los options para crear un select con todos los proveedores
function SelectProveedores()
{
    include("db.php");
    $options = "";
    $sql = "SELECT `id`, `razon_social`, `nombre_comercial`, `cif`, `formapago`, `created_at`, `updated_at` FROM `proveedores` WHERE 1";

    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila["id"] . '">' . $fila["razon_social"] . '-' . $fila["cif"] . '</option>';
        }
    }
    return $options;
}

//devuelve los options para crear un select con todas las provincias
function SelectProvincias()
{
    include("db.php");
    $sqlProvincias = "SELECT `id`, `provincia`, `created_at`, `updated_at` FROM `provincias` WHERE 1 ORDER BY provincia asc";
    $resultProv = $mysqli->query($sqlProvincias);
    if ($resultProv->num_rows > 0) {
        while ($filaProv = $resultProv->fetch_assoc()) {
?>
<option value="<?php echo $filaProv["id"]; ?>"><?php echo $filaProv["provincia"]; ?></option>
<?php
        }
    }
}

//devuelve los options para crear un select con todos los registros de una tabla con value el id.
// valor  visible el campo que pasamos en el argumento $mostrar.
function SelectOptionsId($tabla, $mostrar)
{
    include("db.php");
    $sql = "SELECT `id`, `" . $mostrar . "` FROM `" . $tabla . "`";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila["id"] . '">' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

//devuelve los options para crear un select con todos los registros de una tabla
// con value el campo que pasamos en el argumento $value.
// valor  visible el campo que pasamos en el argumento $mostrar.
function SelectOptions($tabla, $value, $mostrar)
{
    include("db.php");
    $options = "";
    $sql = "SELECT `" . $value . "`, `" . $mostrar . "` FROM `" . $tabla . "`";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

//devuelve los options para crear un select con todos los registros de una tabla con value el id.
// valor  visible el campo que pasamos en el argumento $mostrar.
// ordenados por el campo que pasamos en el argumento $order.
function SelectOptionsIdOrderBy($tabla, $mostrar, $order)
{
    include("db.php");
    $sql = "SELECT `id`, `" . $mostrar . "` FROM `" . $tabla . "` ORDER BY `" . $mostrar . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila["id"] . '">' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

//devuelve los options para crear un select con todos los registros de una tabla
// con value el campo que pasamos en el argumento $value.
// valor  visible el campo que pasamos en el argumento $mostrar.
// ordenados por el campo que pasamos en el argumento $order.
function SelectOptionsOrderBy($tabla, $value, $mostrar, $order)
{
    include("db.php");
    $sql = "SELECT `" . $value . "`, `" . $mostrar . "` FROM `" . $tabla . "` ORDER BY `" . $mostrar . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}
//devuelve los options para crear un select con todos los registros de una tabla
// con value el campo que pasamos en el argumento $value.
// valor  visible DOS campos que pasamos en el argumento $mostrar1,$mostrar2.
// separados por lo que pasemos en el argumento $separador
// ordenados por el campo que pasamos en el argumento $order.
function SelectOptions2CamposOrderBy($tabla, $value, $mostrar1, $mostrar2, $separador, $order)
{
    include("db.php");
    $sql = "SELECT `" . $value . "`, `" . $mostrar1 . "`, `" . $mostrar2 . "` FROM `" . $tabla . "` ORDER BY `" . $mostrar1 . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">' . $fila[$mostrar1] . $separador . $fila[$mostrar2] . '</option>';
        }
    }
    return $options;
}

//devuelve los options para crear un select con todos los registros de una tabla
// con value el campo que pasamos en el argumento $value.
// valor  visible X campos que pasamos en el argumento $Vmostrar que es un string separados por coma.
// separados por lo que pasemos en el argumento $separador
// ordenados por el campo que pasamos en el argumento $order.
function SelectOptionsVariosCamposOrderBy($tabla, $value, $Vmostrar, $separador, $order)
{
    include("db.php");

    $Vmostrar = explode(",", $Vmostrar);
    $sql = "SELECT `" . $value . "` ";
    foreach ($Vmostrar as $mostrar) {
        $sql .= ", `" . $mostrar . "`";
    }
    $sql .= " FROM `" . $tabla . "` ORDER BY `" . $Vmostrar[0] . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">';
            $aux = 0;
            foreach ($Vmostrar as $mostrar) {
                if ($aux == 0) {
                    $options .= $fila[$mostrar];
                    $aux = 1;
                } else {
                    $options .= $separador . $fila[$mostrar];
                }
            }

            $options .= '</option>';
        }
    }
    return $options;
}

// igual arriba
//devuelve los options para crear un select con todos los registros de una tabla
// con value el campo que pasamos en el argumento $value.
// valor  visible X campos que pasamos en el argumento $Vmostrar que es un string separados por coma.
// separados por lo que pasemos en el argumento $separador
// ordenados por el campo que pasamos en el argumento $order.
function SelectOptionsVariosCamposOrderBy2($tabla, $value, $Vmostrar, $separador, $order)
{
    include("db.php");


    $sql = "SELECT `" . $value . "` ";
    $sql .= ", `" . $Vmostrar . "`";
    $sql .= " FROM `" . $tabla . "` ORDER BY `" . $Vmostrar[0] . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">';

            $Vmostrar = explode(",", $Vmostrar);
            $aux = 0;
            foreach ($Vmostrar as $mostrar) {
                if ($aux == 0) {
                    $options .= $fila[$mostrar];
                    $aux = 1;
                } else {
                    $options .= $separador . $fila[$mostrar];
                }
            }

            $options .= '</option>';
        }
    }
    return $options;
}


//devuelve los options para crear un select con todos los registros de una tabla
// con value el campo que pasamos en el argumento $value.
// valor  visible X campos que pasamos en el argumento $Vmostrar que es un vector
// separados por lo que pasemos en el argumento $separador
// ordenados por el campo que pasamos en el argumento $order.
function SelectOptionsVariosCamposOrderByArray($tabla, $value, $Vmostrar, $separador, $order)
{
    include("db.php");

    $sql = "SELECT `" . $value . "` ";
    foreach ($Vmostrar as $mostrar) {
        $sql .= ", `" . $mostrar . "`";
    }
    $sql .= " FROM `" . $tabla . "` ORDER BY `" . $Vmostrar[0] . "` " . $order;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">';
            $aux = 0;
            foreach ($Vmostrar as $mostrar) {
                if ($aux == 0) {
                    $options .= $fila[$mostrar];
                    $aux = 1;
                } else {
                    $options .= $separador . $fila[$mostrar];
                }
            }

            $options .= '</option>';
        }
    }
    return $options;
}




//devuelve los options para crear un select con todos los registros de una tabla con value el id.
// valor  visible el campo que pasamos en el argumento $mostrar.
// seleccionado el que tenga el id igual a $sel(id del selected)
function SelectOptionsIdSel($tabla, $mostrar, $sel)
{
    include("db.php");
    // $sql="SELECT `id`, `".$mostrar."` FROM `".$tabla."`";
    $query = getAll($tabla);
    $options = "";
    //$query=$mysqli->query($sql);    
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            $selected = "";
            if ($fila["id"] == $sel) {
                $selected = "selected";
            }

            $options .= '<option value="' . $fila["id"] . '"   ' . $selected . '   >' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}
//devuelve los options para crear un select con todos los registros de una tabla con value el id.
// valor  visible el campo que pasamos en el argumento $mostrar.
// seleccionado el que tenga el id igual a $sel(id del selected)
//filtrado por una columna
function SelectOptionsIdSelByColumn($tabla, $mostrar, $sel, $column, $valor)
{
    include("db.php");
    // $sql="SELECT `id`, `".$mostrar."` FROM `".$tabla."`";
    $query = getAllByColumn($tabla, $column, $valor);

    $options = "";
    //$query=$mysqli->query($sql);    
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {
            $selected = "";
            if ($fila["id"] == $sel) {
                $selected = "selected";
            }

            $options .= '<option value="' . $fila["id"] . '"   ' . $selected . '   >' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

//devuelve los options para crear un select con todos los registros de una tabla con value $value
// valor  visible el campo que pasamos en el argumento $mostrar.
//filtrado por una columna
function SelectOptionsByColumn($tabla, $value, $mostrar, $column, $valor)
{
    include("db.php");
    $options = "<option></option>";
    $sql = "SELECT `" . $value . "`, `" . $mostrar . "` FROM `" . $tabla . "`";
    $sql .= " WHERE `" . $column . "`='" . $valor . "'";
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        while ($fila = $query->fetch_assoc()) {

            $options .= '<option value="' . $fila[$value] . '">' . $fila[$mostrar] . '</option>';
        }
    }
    return $options;
}

//devuelve los options para crear un select con todas las opciones pasadas como string
// separados por ;
function SelectOpciones($opciones)
{
    $options = "";
    $Vopciones = explode(";", $opciones);
    foreach ($Vopciones as $op) {
        $options .= '<option value="' . $op . '">' . $op . '</option>';
    }

    return $options;
}
//devuelve los options para crear un select con todas las opciones pasadas como string
// separados por ;
// seleccionando el valor pasado por $sel
function SelectOpcionesSel($opciones, $sel)
{
    $options = "";
    $Vopciones = explode(";", $opciones);
    foreach ($Vopciones as $op) {
        $selected = "";
        if ($op == $sel) {
            $selected = "selected";
        }
        $options .= '<option value="' . $op . '"    ' . $selected . '     >' . $op . '</option>';
    }

    return $options;
}

//sube un fichero a una carpeta (la crea si no existe)
// con el nombre indicado $file es un $_FILES
// devuelve la url de subida
// error si no la sube
function UploadFile($file, $carpeta, $nombre)
{
    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0777);
    }

    if ($file["name"] != "") {
        //directorio de subida
        $target_dir = $carpeta . "/";
        //extension archivo que subo
        $imageTypeFile = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        //renombro el archivo
        $target_file = $target_dir . $nombre . "." . $imageTypeFile;

        //borro si existe
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        //subir el archivo y actualizar campo imagen en la tabla
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return "error";
        }
    } else {
        return "error";
    }
}

//sube un fichero a una carpeta 
// con el nombre indicado $file es un $_FILES
// devuelve la url de subida
// vacío si hay error
function uploadfile2($imagen, $target_dir, $nombre)
{

    if ($imagen["name"] != "") {
        //directorio de subida

        //extension archivo que subo
        $imageTypeFile = strtolower(pathinfo($imagen["name"], PATHINFO_EXTENSION));
        //renombro el archivo
        $target_file = $target_dir . "/" . $nombre . "." . $imageTypeFile;
        //subir el archivo y actualizar campo imagen en la tabla
        if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return "";
        }
    } else {
        return "";
    }
}


//sube un fichero a una carpeta
// si existe el archivo lo borra
// con el nombre indicado $file es un $_FILES
// devuelve la url de subida
// vacío si no la sube
function UploadFile3($file, $target_file, $nombre)
{
    if ($file["name"] != "") {
        $archivo = $target_file . "/" . $nombre;
        if (file_exists($archivo)) {
            unlink($archivo);
        }



        //directorio de subida
        $target_dir = $target_file . "/";
        //extension archivo que subo
        $imageTypeFile = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
        //renombro el archivo
        $target_file = $target_dir . $nombre . "." . $imageTypeFile;
        //subir el archivo y actualizar campo imagen en la tabla
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return "";
        }
    } else return "";
}

//devuelve un valor de un campo de una tabla por id
function conseguirValor($tabla, $campo, $id)
{
    include("db.php");
    $fila = "";
    $sql = "SELECT `" . $campo . "` FROM `" . $tabla . "` WHERE `id`=" . $id;
    $query = $mysqli->query($sql);
    if ($query->num_rows > 0) {
        $fila = $query->fetch_assoc();
    }
    return $fila[$campo];
}

//borra un archivo.
function borrarArchivo($target)
{

    if (file_exists($target)) {
        unlink($target);
        return 1;
    } else return 0;
}






?>