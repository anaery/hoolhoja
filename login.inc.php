<?php

if(isset($_POST['login-submit'])){

    require 'mysqli.php';
    $matricula = $_POST['matricula'];
    $password = $_POST['password'];

    if(empty($matricula) || empty($password)){
        header("Location: index.php?error=emptyfields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE usersMatricula=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../../index.php?error=sqlerror1");
            exit();
        } else {

            mysqli_stmt_bind_param($stmt, "s", $matricula);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($result->num_rows > 0){
                if($row = mysqli_fetch_assoc($result)){
                    $pwdCheck = password_verify($password, $row['usersSenha']);
                    if($pwdCheck == false){
                        header("Location: ../../index.php?error=wrongpwd");
                        exit();
                    } else if($pwdCheck == true){
                        if($row['usersStatusConta'] == "Ativa"){
                            session_start();
                            $_SESSION['usersId'] = $row['usersId'];
                            $_SESSION['usersTipo'] = $row['usersTipo'];
                            $_SESSION['usersNome'] = $row['usersNome'];
                            $_SESSION['usersMatricula'] = $row['usersMatricula'];
                            $_SESSION['usersEstado'] = $row['usersEstado'];
                            $_SESSION['usersNivel'] = $row['usersNivel'];
                            $_SESSION['usersImg'] = $row['usersImg'];
                                    
                            header("Location: ../../index.php");
                            exit();
                                
                        } else{
                            header("Location: ../../index.php?error=usernotactive");
                            exit();
                        }
                        
                    } else{
                        header("Location: ../../index.php?error=404");
                        exit();
                    }
                }
            } else {
                header("Location: ../../index.php?error=nouser");
                exit();
            }
        }
    }
}


/* ---------- R E G I S T R A R ---------- */

else if(isset($_POST['reg-submit'])){

    if($_SESSION['registrosContagemStr'] == "0"){
        header("Location: ../../index.php?error=loginfirst");
        exit();
    } else{

        require 'mysqli.php';
        $matricula = $_POST['matricula'];
        $password = $_POST['password'];

        if(empty($matricula) || empty($password)){
            header("Location: ../../index.php?error=emptyfields");
            exit();
        } else{
            $sql = "SELECT * FROM users WHERE usersMatricula=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../../index.php?error=sqlerror1");
                exit();
            } else{

                mysqli_stmt_bind_param($stmt, "s", $matricula);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if($result->num_rows > 0){
                    
                    if($row = mysqli_fetch_assoc($result)){
                        $pwdCheck = password_verify($password, $row['usersSenha']);
                        if($pwdCheck == false){
                            header("Location: ../../index.php?error=wrongpwd");
                            exit();
                        } else if($pwdCheck == true){
                            if($row['usersStatusConta'] == "Ativa"){
    
                                session_start();
    
                                $_SESSION['usersNome'] = $row['usersNome'];
                                $_SESSION['usersMatricula'] = $row['usersMatricula'];
                                $_SESSION['usersEstado'] = $row['usersEstado'];
    
                                /* -------------------- if contatem = 1 -------------------- */
                                if($_SESSION['registrosContagemStr'] == "1"){
    
                                    $userAgora = $_SESSION['usersMatricula'];
    
                                    $sql = "SELECT * FROM users WHERE usersEstado=?";
                                    $stmt = mysqli_stmt_init($conn);
                                    if(!mysqli_stmt_prepare($stmt, $sql)){
                                        header("Location: ../../index.php?error=sqlerror9999");
                                        exit();
                                    } else{
                                        $dentro = "Dentro";
                                        mysqli_stmt_bind_param($stmt, "s", $dentro);
                                        mysqli_stmt_execute($stmt);
                                        $result = mysqli_stmt_get_result($stmt);
                                        if($row = mysqli_fetch_assoc($result)){
    
                                            $userAnterior = $row['usersMatricula'];
    
                                            if($userAgora == $userAnterior){
                                                
                                                /* Logout */
                                                session_unset();
                                                session_destroy();
    
                                                header("Location: ../../index.php?error=loginfirst");
                                                exit();
                                                
                                            } else{
                                                if($_SESSION['usersEstado'] == "Fora"){
    
                                                    // reg Entrar
                                                    $name = $_SESSION['usersNome'];
                                                    $matricula = $_SESSION['usersMatricula'];
                                                    $action = "Entrar";
                    
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
                                                            $contagem = $contagem + 1;
                    
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
                                                                    $estado = "Dentro";
                                                                    mysqli_stmt_bind_param($stmt, "ss", $estado, $matricula);
                                                                    mysqli_stmt_execute($stmt);
                    
                                                                    /* Logout */
                                                                    session_unset();
                                                                    session_destroy();
        
                                                                    header("Location: ../../index.php?reg-entrada1=success");
                                                                    exit();
                                                                }
                                                            }
                                                        }
                                                    }
    
                                                } else if($_SESSION['usersEstado'] == "Dentro"){
                    
                                                    // reg Sair
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
    
                                                                    /* Logout */
                                                                    session_unset();
                                                                    session_destroy();
            
                                                                    header("Location: ../../index.php?reg-saida1=success");
                                                                    exit();
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
    
                                }  /* -------------------- end if contatem = 1 -------------------- */
                                
                                else{
                                    
                                    if($_SESSION['usersEstado'] == "Fora"){
    
                                        // reg Entrar
                                        $name = $_SESSION['usersNome'];
                                        $matricula = $_SESSION['usersMatricula'];
                                        $action = "Entrar";
        
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
                                                $contagem = $contagem + 1;
        
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
                                                        $estado = "Dentro";
                                                        mysqli_stmt_bind_param($stmt, "ss", $estado, $matricula);
                                                        mysqli_stmt_execute($stmt);
        
                                                        /* Logout */
                                                        session_unset();
                                                        session_destroy();
    
                                                        header("Location: ../../index.php?reg-entrada1=success");
                                                        exit();
                                                    }
                                                }
                                            }
                                        }
        
                                    } else if($_SESSION['usersEstado'] == "Dentro"){
        
                                        // reg Sair
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
        
                                                        /* Logout */
                                                        session_unset();
                                                        session_destroy();
    
                                                        header("Location: ../../index.php?reg-saida1=success");
                                                        exit();
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }     
                            } else{
                                header("Location: ../../index.php?error=usernotactive");
                                exit();
                            }
                            
                        } else{
                            header("Location: ../../index.php?error=nouser");
                            exit();
                        }
                    }
    
                } else {
                    header("Location: ../../index.php?error=nouser");
                    exit();
                }
            }
        }
    }
}

else{
    header("Location: ../../index.php");
    exit();
}