<?php

// NOMBRE DE LA CLASE 
class clsServicios
{

  // PROGRAMACIÓN DE MÉTODOS
  public function sp_Acceso($usu, $pwd)
  {

    // Se estructura el comando SQL para ejecutar 
    $cmdSql = "call sp_Acceso('$usu','$pwd');";

    // -------------------------------------------------
    // Variable para recepción de estatus+datos
    $datos = array();

    if ($conn = mysqli_connect("localhost", "root", "Maple0017", "prosoft")) {
      // Ejecución del comando SQL y recibir resultados (recordset)
      $renglon = mysqli_query($conn, $cmdSql);

      if ($renglon) {
        // Ciclo para lectura de registros
        $resultado = mysqli_fetch_assoc($renglon);
        if ($resultado) {
          $datos[0]["BAN"] = $resultado["usu_ban"];
          if ($datos[0]["BAN"] == "1") {
            // El usuario existe en BD, extraer los demás datos
            $datos[1]["CVE"] = $resultado["usu_cve_usuario"];
            $datos[2]["NOM"] = $resultado["usu_nombre"];
            $datos[3]["USU"] = $resultado["usu_usuario"];
            $datos[4]["ROL"] = $resultado["rol_nombre"];
          }
        } else {
          $datos[0]["BAN"] = "0";
        }
      } else {
        $datos[0]["BAN"] = "0";
      }

      // Cerrar conexión
      mysqli_close($conn);
    }
    // Retornar el arreglo formateado y con los datos de resultado
    return $datos;
  }
  // -------------------------






}
