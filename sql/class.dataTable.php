<?php

include_once ("class.managerDB.php");

class dataTable {

    //constructor
    function dataTable() {
        
    }

    function obtener_usuarios() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT id, nombre, (CASE WHEN correo!='' THEN correo ELSE 'Correo no ingresado' END) AS correo, (CASE WHEN telefono!='' THEN telefono ELSE 'Teléfono no ingresado' END) AS telefono, estado, tipo, usuario 
                    FROM contactos
                    ORDER BY estado DESC";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_siembras() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT pe.*, b.nombre AS nombre_bodega, t.*, tv.nombre AS nombre_vegetacion FROM proyectos_enc pe INNER JOIN bodega b ON pe.bodega_seleccionada = b.codigo INNER JOIN proyecto_tablones pt ON pt.id_proyecto=pe.id_proyecto INNER JOIN tablones t ON t.id::character varying(255) = pt.id_tablones INNER JOIN tipo_vegetacion tv ON pe.tipo_cultivo = tv.id ORDER BY pe.cerrado ASC";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_cosechas() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM proyectos_enc WHERE cerrado = 'true'";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_cuenta_contable() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM cn_catalogo";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_razas() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM razas";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_colores() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM colores";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_grupos() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM grupos";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_peso_animal() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM bit_peso_animal";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_peso_leche() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM pesos_leches ORDER BY fecha DESC";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_analisis_leche() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM analisis_leche";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_servicios() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT s.*, c.nombre FROM servicios s INNER JOIN cat_tipos_servicios c ON s.tipo = c.id::character varying ORDER BY s.fecha DESC";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_palpaciones() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT *, prenada FROM palpaciones ORDER BY fecha DESC";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_resultados_palpaciones() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM resul_palpaciones";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_partos() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM partos ORDER BY fecha::date DESC";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_mortalidad() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM mortalidades ORDER BY fecha::date DESC";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_causa_mortalidad() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM causas_mortalidades ORDER BY nombre ASC";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_controles_sanitarios() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT DISTINCT animal FROM controles_sanitarios";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_eventos_sanitarios() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM eventos_sanitarios";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_pruebas_cmt() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT DISTINCT fecha, COUNT(fecha) animales_revisados FROM pruebas_cmt GROUP BY fecha";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_visita_medica() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM visita_medica";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_plantilla_requisicion() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT b.id, b.nombre FROM plantilla_servicios_requisicion_enc a JOIN cat_tipos_servicios b ON a.id_tipo=b.id";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function obtener_tratamiento_medico() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT * FROM tratamientos_enc";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }

    function calcular_costo_proyecto($id){
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT sum(subtotal::numeric(1000,2)) total FROM proyectos_lns WHERE enc_id='$id'";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return floatval($response);
        unset($connection);
        unset($query);
    }

    function obtener_animales() { 
        $managerDB = new managerDB(); 
        $connection = $managerDB->conectar("pgsql"); 
        if ($connection!=null) {
            $response=array('success'=>true);
                $sql = "SELECT *, to_char(current_date,'DD MM YYYY')::date - (SELECT fecha FROM partos WHERE animal=numero||'-'||nombre ORDER BY fecha::date desc limit 1)::date dias_lactancia FROM animales";
            try {
                $query=$connection->prepare($sql);
                    $query->execute();
                $response['items']=$query->fetchAll(PDO::FETCH_ASSOC);
                $response['total']=$query->rowCount();
            } catch(PDOException $error) { 
                if ($transaction) $connection->rollback();
                $response= array('success'=>false, 'error'=>$error->getMessage());
            }
        } else {
            $response= array('success'=>false, 'error'=>'No está conectado al servidor de bases de datos.');
        }
        return $response;
        unset($connection);
        unset($query);
    }
}
?>