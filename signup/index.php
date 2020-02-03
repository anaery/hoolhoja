<!DOCTYPE HTML>
<html>
	<head>
		<title>LPA - Cadastro</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="../_src/includes/images/icons/favicon.ico"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../_css/main.css" />
		<link rel="stylesheet" href="../_css/index.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
		<noscript><link rel="stylesheet" href="../_css/ext/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="../index.php">LPA</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="../index.php"><span>Voltar</span></a>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<article id="main">
						<!-- comeco do bloco de cabeçalho -->
						<header>
							<h2>Cadastro</h2>
						</header>
						<!-- fim do cabecalho -->
						<!-- wrapper style1, 2,3,4,5 muda a cor de fundo-->
						<section class="wrapper style5" style="padding: 2em 0 2em 0;">
							<div class="inner">

								<center>
									<!-- comeco do formulario -->
									<form action="../_src/includes/signup.inc.php" method="post" id="form1" enctype="multipart/form-data" autocomplete="off">
										<!-- caso o nome nao esteja completo esse codigo é executado -->
										<?php
											if(isset($_GET['error'])){
												if($_GET['error'] == "notcompletename"){
													echo '<center><p style="color:red; margin: 20px 0 10px !important;">Insira seu nome completo!</p></center>';
												}
											}
										?>

										<!-- bloco de input de nome -->
										<div class="wrap-input100 validate-input" data-validate = "Insira seu nome completo">
											<input class="input100" type="text" name="name" placeholder="Nome completo" value="<?php 
												if(isset($_GET['error'])){
													echo $_GET['nome']; 
												}?>">
											<span class="focus-input100"></span>
											<span class="symbol-input100">
												<i class="fas fa-user" aria-hidden="true"></i>
											</span>
										</div>
												
										<style> input[type='file'] { display: none !important; } </style>

										<!-- caso o nome nao haja foto esse codigo é executado -->		
										<?php
											if(isset($_GET['error'])){
												if($_GET['error'] == "emptyimg"){
													echo '<center><p style="color:red; margin: 20px 0 10px !important;">Selecione uma imagem de perfil!</p></center>';
												}
												if($_GET['error'] == "notcompletename"){
													echo '<center><p style="color:red; margin: 20px 0 10px !important;">Por favor, selecione uma imagem de perfil novamente.</p></center>';
												}
												if($_GET['error'] == "matriculataken"){
													echo '<center><p style="color:red; margin: 20px 0 10px !important;">Por favor, selecione uma imagem de perfil novamente.</p></center>';
												}
												if($_GET['error'] == "emailtaken"){
													echo '<center><p style="color:red; margin: 20px 0 10px !important;">Por favor, selecione uma imagem de perfil novamente.</p></center>';
												}
												if($_GET['error'] == "passwordlength"){
													echo '<center><p style="color:red; margin: 20px 0 10px !important;">Por favor, selecione uma imagem de perfil novamente.</p></center>';
												}
											}
										?>
											<!-- bloco de input de email -->
										<div class="wrap-input100">
											<label for='input-file' class="input100" style="padding-top: 15px !important; text-align: left !important; color: rgb(142, 136, 146) !important;">
											<span id='file-name'></span><span id='placeholder'>Imagem de perfil</span> 
											<input id='input-file' type='file' value='' class="input100"  type="file" name="file"></label>
											
											<span class="focus-input100"></span>
											<span class="symbol-input100">
												<i class="fas fa-user-circle"></i>
											</span>
										</div>
                                        
                                        <?php
                                            $engElet = "";
                                            $sistInt = "";
                                            $fis = "";
                                            $eletr = "";

                                            if(isset($_GET['error'])){
                                                if(isset($_GET['curso'])){
                                                    if($_GET['curso'] == "Engenharia Elétrica"){
                                                        $engElet = "selected";
                                                    } else if($_GET['curso'] == "Sistemas para Internet"){
                                                        $sistInt = "selected";
                                                    } else if($_GET['curso'] == "Física"){
                                                        $fis = "selected";
                                                    } else if($_GET['curso'] == "Eletrotécnica"){
                                                        $eletr = "selected";
                                                    } else if($_GET['curso'] == "Outro"){
                                                        $outro = "selected";
                                                    }  
                                                }
                                            }
										?>
											<!-- caso o nome nao tenha curso selecionado esse codigo é executado -->
											
											<!-- bloco de input do curso -->
										<div class="wrap-input100 validate-input" data-validate = "Insira seu curso">
											<span class="symbol-input100">
												<i class="fas fa-hat-wizard"></i>
                                            </span>
                                            <select class="input100" name="curso" id="demo-category">
                                                <option value="0">Curso</option>
                                                <option value="Engenharia Elétrica" <?php echo $engElet; ?>>Engenharia Elétrica</option>
                                                <option value="Sistemas para Internet" <?php echo $sistInt; ?>>Sistemas para Internet</option>
                                                <option value="Física" <?php echo $fis; ?>>Física</option>
                                                <option value="Eletrotécnica" <?php echo $eletr; ?>>Eletrotécnica</option>
												<option value="Outro" <?php echo $outro; ?>>Outro</option>
                                            </select>    
										</div>
										
										<!-- caso o nome nao haja matricula esse codigo é executado -->
										<?php
											if(isset($_GET['error'])){
												if($_GET['error'] == "matriculataken"){
													echo '<center><p style="color:red; margin: 20px 0 10px !important;">Já existe um usuário com essa matrícula!</p></center>';
												}
											}
										?>
										<!-- bloco de input da matricula -->
										<div class="wrap-input100 validate-input" data-validate = "Insira sua matrícula">
											<input class="input100" type="text" name="matricula" placeholder="Matrícula" value="<?php 
												if(isset($_GET['error'])){
													echo $_GET['matricula']; 
												}?>">
											<span class="focus-input100"></span>
											<span class="symbol-input100">
												<i class="fas fa-id-card-alt" aria-hidden="true"></i>
											</span>
										</div>
												<!-- caso o nome nao haja email esse codigo é executado -->
										<?php
											if(isset($_GET['error'])){
												if($_GET['error'] == "emailtaken"){
													echo '<center><p style="color:red; margin: 20px 0 10px !important;">Já existe um usuário com esse e-mail!</p></center>';
												}
											}
										?>
										<!-- bloco de input do email -->
										<div class="wrap-input100 validate-input" data-validate = "Insira seu e-mail">
											<input class="input100" type="text" name="mail" placeholder="E-mail" value="<?php 
												if(isset($_GET['error'])){
													echo $_GET['email']; 
												}?>">
											<span class="focus-input100"></span>
											<span class="symbol-input100">
												<i class="fa fa-envelope" aria-hidden="true"></i>
											</span>
										</div>
										<?php
											if(isset($_GET['error'])){
												if($_GET['error'] == "passwordlength"){
													echo '<center><p style="color:red; margin: 20px 0 10px !important;">A senha precisa ter pelo menos 6 caracteres!</p></center>';
												}
											}
										?>
										<div class="wrap-input100 validate-input" data-validate = "Insira sua senha">
											<input class="input100" type="password" name="password" placeholder="Senha">
											<span class="focus-input100"></span>
											<span class="symbol-input100">
												<i class="fa fa-lock" aria-hidden="true"></i>
											</span>
										</div>
												
										<div class="wrap-input100 validate-input" data-validate ="Repita sua senha">
											<input class="input100" type="password" name="password-repeat" placeholder="Repita a senha">
											<span class="focus-input100"></span>
											<span class="symbol-input100">
												<i class="fa fa-lock" aria-hidden="true"></i>
											</span>
										</div>
										
										<div class="container-login100-form-btn">
											<button  class="button primary fit" type="submit" name="signup-submit" style="margin-top:20px;">
												Cadastrar
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
		<script src="_js/ext/jquery.min.js"></script>
			<script src="_js/ext/jquery.scrollex.min.js"></script>
			<script src="_js/ext/jquery.scrolly.min.js"></script>
			<script src="_js/ext/browser.min.js"></script>
			<script src="_js/ext/breakpoints.min.js"></script>
			<script src="_js/util.js"></script>
			<script src="_js/main.js"></script>

			<script src="_js/sweetalert2/dist/sweetalert2.all.min.js"></script>
    		<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
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