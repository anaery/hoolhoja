<?php
session_start();

if(isset($_POST['reg-saida-submit'])){

    require '../dbh/mysqli.php';

    $name = $_SESSION['usersNome'];
    $matricula = $_SESSION['usersMatricula'];
    $action = "Sair";

    $sql = "SELECT * FROM registros ORDER BY registrosId DESC LIMIT 1";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../../index.php?error=sqlerror1");
        exit();
    } else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $contagem = $row['registrosContagem'];
            $contagem = intval($contagem);
            $contagem = $contagem - 1;

            $sql = "INSERT INTO registros (registrosNome, registrosRegistro, registrosMatricula, registrosContagem) 
                VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../../index.php?error=sqlerror2");
                exit();
            } else{
                mysqli_stmt_bind_param($stmt, "ssss", $name, $action, $matricula, $contagem);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                
                $sql = "UPDATE users SET usersEstado = ? WHERE usersMatricula = ?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../../index.php?error=sqlerror3");
                    exit();
                } else{
                    $estado = "Fora";
                    mysqli_stmt_bind_param($stmt, "ss", $estado, $matricula);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);

                    $_SESSION['usersEstado'] = "Fora";

                    $sql = "SELECT * FROM registros ORDER BY registrosId DESC LIMIT 1";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt, $sql)){
                            header("Location: ../../index.php?error=sqlerror99");
                            exit();
                        } else{
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            if($row = mysqli_fetch_assoc($result)){
                                $contagem = $row['registrosContagem'];
                                $contagem = intval($contagem);
                                $_SESSION['registrosContagem'] = $contagem;

                                header("Location: ../../index.php?reg-saida=success");
                                exit();
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
    header("Location: ../index.php");
    exit();
}