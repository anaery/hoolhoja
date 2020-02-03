<?php 
require 'dbh.inc.php';

if(isset($_POST['submit'])) {

	$_file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));

	$allowed = array('jpg', 'jpeg', 'png', 'pdf');

	if(in_array($fileActualExt, $allowed)) {
		if($fileError === 0){
			if($fileSize < 5000000){
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination= 'images/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: index.php?upload_success");
			}else {
				echo " o arquivo é muito grande";
			}
		} else{
			echo "ocorreu um erro!";
		}
	} else {
		echo "voce nao pode upar arquivos desse tipo!";
	}


}
