<?
if(isset($_POST)){
    session_start();
    include_once("../configuracion/abrirbdi.php");
    include_once("../lee_basei.php");

    $programa = $_POST['programa'];
    $accion = $_POST['accion'];

    $arr_programa = explode("/", $programa);
    $programa = strtoupper(str_replace(array(".php","#"), "", $arr_programa[count($arr_programa)-1]));

    if($accion == "agregar"){
        $resultado['mensaje'] = agregar_favorito($programa);
        $resultado['favorito'] = "<li><a href='".strtolower($programa).".php' target='_parent'>".strtolower($programa)."</a></li>\n";
    }
    if($accion == "eliminar"){
        $resultado['mensaje'] = quitar_favorito($programa);
        $resultado['programa'] = strtolower($programa);
    }
    echo json_encode($resultado);
    die;
}


function agregar_favorito($programa){
    $usuario = trim($_SESSION['usuario']);
    if($programa != ""){
      ejecuta_query("set isolation to dirty read");
        $sql_verif = "select programa, length(programa) tamano from nue_perpro where usuario = '$usuario' and (programa = '$programa' or 'P'||programa = '$programa') and f_expira_p >= today order by 2 asc";
        $mat_verif = lee_todo($sql_verif);
        if(count($mat_verif) > 0){
            $programa = $mat_verif[0]['programa'];
            $sql_verif = "select * from ins_favoritos where usuario = '$usuario' and programa = '$programa'";
            $mat_verif = lee_todo($sql_verif);
            if(count($mat_verif) == 0){
                $sql_ins = "insert into ins_favoritos values ('$usuario','$programa',current)";
                ejecuta_query($sql_ins);
                return "Exitoso";
            } else {
                return "Favorito agregado previamente";
            }
        } else {
            return "Programa $programa no existe o no tiene permiso";
        }
    }
}

function quitar_favorito($programa){
    if($programa != ""){
        $usuario = trim($_SESSION['usuario']);
        $sql_ins = "delete from ins_favoritos where usuario = '$usuario' and (programa = '$programa' or 'P'||programa = '$programa')";
        ejecuta_query($sql_ins);
        return "Exitoso";
    }
}

?>