<?php
    session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>LPA - Alterar senha</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
				integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
		<link rel="stylesheet" href="../_css/main.css" />
		<link rel="stylesheet" href="../_css/signup.css" />
		<noscript>
		<link rel="stylesheet" href="../_css/ext/noscript.css" />
		</noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="../">GATE</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="../"><span>Voltar</span></a>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<article id="main">
						<header>
							<h2>Editar Cadastro</h2>
							
						</header>

						<section class="wrapper style5" style="padding: 2em 0 2em 0;">
							<div class="inner">
								<!-- formulario pra mudar senha -->
								<center>
									<h3>Alterar senha</h3>
                                    <form action="inc/change-password.inc.php" method="post" id="form1" enctype="multipart/form-data" autocomplete="off">

                                        <div class="wrap-input100 validate-input" data-validate = "Insira a nova senha">
                                            <input class="input100" type="password" name="pwd" placeholder="Nova senha">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </span>
                                        </div>

                                        <div class="wrap-input100 validate-input" data-validate = "Repita a nova senha">
                                            <input class="input100" type="password" name="pwd-repeat" placeholder="Repita a senha">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-lock" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        
                                        <div class="container-login100-form-btn">
											<button  class="button primary fit" type="submit" name="change-password-submit" style="margin-top:20px;">
												Salvar
											</button>
										</div>
									</form>
									
									<!-- formulario pra mudar imagem -->
									<h3>Alterar imagem</h3>
									 <form action="inc/change-profile-picture.inc.php" method="post" id="form1" enctype="multipart/form-data" autocomplete="off">

                                        <style> input[type='file'] { display: none !important; } </style>
				
                                        <?php
                                            if(isset($_GET['error'])){
                                                if($_GET['error'] == "emptyimg"){
                                                    echo '<center><p style="color:red; margin: 20px 0 10px !important;">Selecione uma imagem de perfil!</p></center>';
                                                }
                                            }
                                        ?>

                                        <div class="wrap-input100">
                                            <label for='input-file' class="input100" style="padding-top: 15px !important; text-align: left !important; color: rgb(142, 136, 146) !important;">
                                            <span id='file-name'></span><span id='placeholder'>Imagem de perfil</span> 
                                            <input id='input-file' type='file' value='' class="input100"  type="file" name="file"></label>
                                            
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fas fa-user-circle"></i>
                                            </span>
                                        </div>
                                        
                                        <div class="container-login100-form-btn">
											<button  class="button primary fit" type="submit" name="change-profile-picture-submit" style="margin-top:20px;">
												Salvar
											</button>
										</div>

									</form>
									<!-- formulario pra mudar e-mail -->
									<h3>Alterar e-mail</h3>
									 <form action="inc/change-email.inc.php" method="post" id="form1" enctype="multipart/form-data" autocomplete="off">

                                        <div class="wrap-input100 validate-input" data-validate = "Insira a nova senha">
                                            <input class="input100" type="email" name="email" placeholder="Novo e-mail">
                                            <span class="focus-input100"></span>
                                            <span class="symbol-input100">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                            </span>
                                        </div>

                                        
                                        <div class="container-login100-form-btn">
											<button  class="button primary fit" type="submit" name="change-email-submit" style="margin-top:20px;">
												Salvar
											</button>
										</div>

									</form>
								</center>

							</div>
						</section>
					</article>

				<!-- Footer -->
					<?php
					require_once('../_src/footer.php');
					?>

			</div>

		<!-- Scripts -->
			<script src="js/jquery.min.js"></script>
			<script src="js/jquery.scrollex.min.js"></script>
			<script src="js/jquery.scrolly.min.js"></script>
			<script src="js/browser.min.js"></script>
			<script src="js/breakpoints.min.js"></script>
			<script src="js/util.js"></script>
			<script src="js/main.js"></script>

			<script src="js/main.js"></script>
            <script>
                function chooseFile() {
                    $("#fileInput").click();
                }
			</script>
			
			<script >
                var $input    = document.getElementById('input-file'),
                    $fileName = document.getElementById('file-name');
                    $placeholder = document.getElementById('placeholder');
                
                $input.addEventListener('change', function(){
                    $fileName.textContent = this.files[0].name; //this.value
                    $placeholder.textContent = null;
                });
            </script>

	</body>
</html>