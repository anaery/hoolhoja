<?php
session_start();

if(isset($_GET['usersId'])){

    require '../dbh/mysqli.php';

    $id = $_GET['usersId'];
    $action = "E.C.";

    $sql = "SELECT usersNome, usersMatricula FROM users WHERE usersId=?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../../index.php?error=sqlerror1");
        exit();
    } else{
        mysqli_stmt_bind_param($stmt, "s", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){

            $name = $row['usersNome'];
            $matricula = $row['usersMatricula'];

            $sql = "SELECT registrosId, registrosContagem FROM registros WHERE registrosMatricula=? ORDER BY registrosId DESC LIMIT 1";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../../index.php?error=sqlerror2");
                exit();
            } else{
                mysqli_stmt_bind_param($stmt, "s", $matricula);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                if($row = mysqli_fetch_assoc($result)){
                    $idRegistros = $row['registrosId'];
                    $contagem = $row['registrosContagem'];
                    $contagem = intval($contagem);
                    $contagem = $contagem - 1;

                    $sql = "UPDATE registros SET registrosRegistro=?, registrosContagem=? WHERE registrosId=?";
                    $stmt = mysqli_stmt_init($conn);

                    if(!mysqli_stmt_prepare($stmt, $sql)){
                        header("Location: ../../index.php?error=sqlerror3");
                        exit();
                    } else{
                        mysqli_stmt_bind_param($stmt, "sss", $action, $contagem, $idRegistros);
                        mysqli_stmt_execute($stmt);

                        $sql = "SELECT registrosId, registrosContagem FROM registros WHERE registrosId>?";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../../index.php?error=sqlerror33");
                            exit();
                        } else{
                            mysqli_stmt_bind_param($stmt, "s", $idRegistros);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            /* fetch associative array (para cada resultado retornado do banco, irá fazer o que está no while loop) */
                            while($row = mysqli_fetch_assoc($result)){
                                
                                $idDesteRegistro = $row['registrosId'];

                                $contagemDesteRegistro = $row['registrosContagem'];
                                $contagemDesteRegistro = intval($contagemDesteRegistro);
                                $contagemDesteRegistro = $contagemDesteRegistro - 1;

                                $sql = "UPDATE registros SET registrosContagem=? WHERE registrosId=?";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                    header("Location: ../../index.php?error=sqlerror333");
                                    exit();
                                } else{
                                    mysqli_stmt_bind_param($stmt, "ss", $contagemDesteRegistro, $idDesteRegistro);
                                    mysqli_stmt_execute($stmt);
                                }

                            }
                            /* free result set */
                            mysqli_free_result($result);

                        
                            $sql = "UPDATE users SET usersEstado = ? WHERE usersMatricula = ?";
                            $stmt = mysqli_stmt_init($conn);
                            if(!mysqli_stmt_prepare($stmt, $sql)){
                                header("Location: ../../index.php?error=sqlerror4");
                                exit();
                            } else{
                                $estado = "Fora";
                                mysqli_stmt_bind_param($stmt, "ss", $estado, $matricula);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);

                                $sql = "SELECT * FROM registros ORDER BY registrosId DESC LIMIT 1";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt, $sql)){
                                    header("Location: ../../index.php?error=sqlerror5
                                    ");
                                    exit();
                                } else{
                                    mysqli_stmt_execute($stmt);
                                    $result = mysqli_stmt_get_result($stmt);
                                    if($row = mysqli_fetch_assoc($result)){
                                        $contagem = $row['registrosContagem'];
                                        $contagem = intval($contagem);
                                        $_SESSION['registrosContagem'] = $contagem;

                                        header("Location: ../reg-users.php?reg-saida=success");
                                        exit();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

else{
    header("Location: ../../index.php");
    exit();
}