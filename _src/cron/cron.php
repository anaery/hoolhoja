<?php

include_once 'includes/dbh.inc.php';

$sql = "SELECT usersId FROM users WHERE usersEstado='Dentro'";

$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)){
    header("Location: ../index.php?error=sqlerror33");
    exit();
} else{
    mysqli_stmt_execute($stmt);
    $result0 = mysqli_stmt_get_result($stmt);
    // fetch associative array (para cada resultado retornado do banco, irá fazer o que está no while loop)
    while($row0 = mysqli_fetch_assoc($result0)){
        
        $id = $row0['usersId'];
        $action = "E.C.";

        echo "Id result ".$id."<br>";

        $sql = "SELECT usersNome, usersMatricula FROM users WHERE usersId=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror1");
            exit();
        } else{
            mysqli_stmt_bind_param($stmt, "s", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row1 = mysqli_fetch_assoc($result)){

                $name = $row1['usersNome'];
                $matricula = $row1['usersMatricula'];

                echo "Name result ".$name."<br>";
                echo "Matricula result ".$matricula."<br>";

                $sql = "SELECT registrosId, registrosContagem FROM registros WHERE registrosMatricula=? ORDER BY registrosId DESC LIMIT 1";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../index.php?error=sqlerror2");
                    exit();
                } else{
                    mysqli_stmt_bind_param($stmt, "s", $matricula);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if($row2 = mysqli_fetch_assoc($result)){
                        $idRegistros = $row2['registrosId'];
                        $contagem = $row2['registrosContagem'];
                        $contagem = intval($contagem);
                        $contagem = $contagem - 1;

                        $sql = "UPDATE registros SET registrosRegistro=?, registrosContagem=? WHERE registrosId=?";
                        $stmt = mysqli_stmt_init($conn);

                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../index.php?error=sqlerror3");
                            exit();
                        } else{
                            mysqli_stmt_bind_param($stmt, "sss", $action, $contagem, $idRegistros);
                            mysqli_stmt_execute($stmt);

                            $sql = "SELECT registrosId, registrosContagem FROM registros WHERE registrosId>?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                header("Location: ../index.php?error=sqlerror33");
                                exit();
                            } else{
                                mysqli_stmt_bind_param($stmt, "s", $idRegistros);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                // fetch associative array (para cada resultado retornado do banco, irá fazer o que está no while loop)
                                while($row3 = mysqli_fetch_assoc($result)){
                                    
                                    $idDesteRegistro = $row3['registrosId'];

                                    $contagemDesteRegistro = $row3['registrosContagem'];
                                    $contagemDesteRegistro = intval($contagemDesteRegistro);
                                    $contagemDesteRegistro = $contagemDesteRegistro - 1;

                                    $sql = "UPDATE registros SET registrosContagem=? WHERE registrosId=?";
                                    $stmt = mysqli_stmt_init($conn);
                                    if(!mysqli_stmt_prepare($stmt, $sql)){
                                        header("Location: ../index.php?error=sqlerror333");
                                        exit();
                                    } else{
                                        mysqli_stmt_bind_param($stmt, "ss", $contagemDesteRegistro, $idDesteRegistro);
                                        mysqli_stmt_execute($stmt);
                                    }

                                }
                                // free result set
                                //mysqli_free_result($result);

                            
                                $sql = "UPDATE users SET usersEstado = ? WHERE usersMatricula = ?";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                    header("Location: ../index.php?error=sqlerror4");
                                    exit();
                                } else{
                                    $estado = "Fora";
                                    mysqli_stmt_bind_param($stmt, "ss", $estado, $matricula);
                                    mysqli_stmt_execute($stmt);

                                    echo "Entrada cancelada registrada.<br><br>";
                                }
                            }
                        }
                    }
                }
            }
        }
        
        //mysqli_stmt_close($stmt);
    }
    
    // free result set
    //mysqli_free_result($result);
}

$sql = "UPDATE registros SET registrosRegistro = 'Fechar' WHERE registrosContagem = 0 AND registrosRegistro = 'Sair'";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Error 1";
} else {
    mysqli_stmt_execute($stmt);
    
    echo "Corrigir Sair para Fechar => OK<br>";
}

$sql = "UPDATE registros SET registrosRegistro = 'Abrir' WHERE registrosContagem = 1 AND registrosRegistro = 'Entrar'";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Error 2";
} else {
    mysqli_stmt_execute($stmt);

    echo "Corrigir Entrar para Abrir => OK<br>";
}