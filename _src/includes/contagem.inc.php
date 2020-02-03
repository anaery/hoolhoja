<?php    
    include_once '../dbh/mysqli.php';

    $sql = "SELECT * FROM registros ORDER BY registrosId DESC LIMIT 1";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        echo "error";
        exit();
    } else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
            $contagem = $row['registrosContagem'];
            echo $contagem;
            //$contagem = intval($contagem);
        }
    }
?>