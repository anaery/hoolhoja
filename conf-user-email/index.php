<!DOCTYPE HTML>
<html>
	<head>
		<title>GATE</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../_css/main.css" />
		<link rel="stylesheet" href="../_css/signup.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
		<noscript><link rel="stylesheet" href="../_css/ext/noscript.css" /></noscript>
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
							<h2>Confirmação de E-mail</h2>
						</header>
						<section class="wrapper style5" style="padding: 2em 0 2em 0;">
							<div class="inner">
							<section>
								
								<?php
								if ( isset($_GET['email']) ) {
									$email = $_GET['email'];
									if(empty($email)){
								?>
										<center>
											<p>Não foi possí­vel validar o seu pedido. Entre em contato com um administrador.</p>
											<p>Erro: e-mail não identificado.</p>
											<a href="../">Voltar para o iní­cio</a>
										</center>
								<?php
									} else{
										$email = $_GET['email'];
										require '../_src/dbh/mysqli.php';
										$statusconta = "ConfAdmin";
																		
										// Verificando se existe um usuário cadastrado com o e-mail inserido
										$sql = "SELECT usersEmail FROM users WHERE usersEmail=?";
										$stmt = mysqli_stmt_init($conn);
										if(!mysqli_stmt_prepare($stmt, $sql)){
											header("Location: ../signup.php?error=sqlerror33");
											exit();
										} else{
											mysqli_stmt_bind_param($stmt, "s", $email);
											mysqli_stmt_execute($stmt);
											mysqli_stmt_store_result($stmt);
											$resultCheck = mysqli_stmt_num_rows($stmt);
											if($resultCheck > 0){
												
												$sql = "UPDATE users SET usersStatusConta=? WHERE usersEmail=?";
												$stmt = mysqli_stmt_init($conn);
												if(!mysqli_stmt_prepare($stmt, $sql)){
								?>
													<center>
													<p>Não foi possí­vel validar o seu pedido. Entre em contato com um administrador.</p>
													<p>Erro: não foi possível conectar com o sistema.</p>
													<a href="../">Voltar para o iní­cio</a>
													</center>
								<?php
												} else {
													mysqli_stmt_bind_param($stmt, "ss", $statusconta, $email);
													mysqli_stmt_execute($stmt);
								?>
													<center>
														<p>Seu e-mail foi confirmado!</p>
														<p>Seus dados serão analisados por um administrador e sua conta será ativada o mais breve possí­vel.</p>
														<a href="../">Voltar para o iní­cio</a>
													</center>
								<?php
												}
											} else{
								?>
												<center>
													<p>Não foi possível validar o seu pedido. Entre em contato com um administrador.</p>
													<p>Erro: não foi possí­vel encontrar o cadastro desejado.</p>
													<a href="../">Voltar para o iní­cio</a>
												</center>
								<?php
											}
										}
									}
								} else {
								?>
										<center>
											<p>Não foi possí­vel validar o seu pedido. Entre em contato com um administrador.</p>
											<p>Erro: e-mail não identificado.</p>
											<a href="../">Voltar para o iní­cio</a>
										</center>
								<?php
								}
								?>
							</section>
							
							</div>
						</section>
					</article>

				<!-- Footer -->
					<?php
					require_once('../_src/footer.php');
					?>

			</div>

	</body>
</html>