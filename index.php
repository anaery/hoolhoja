<?php
    session_start();
		include_once('_src/dbh/mysqli.php');
    $_SESSION['conf-cadastro'] = "";

    $sql = "SELECT * FROM registros ORDER BY registrosId DESC LIMIT 1";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../index.php?error=sqlerror99");
        exit();
    } else{
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($row = mysqli_fetch_assoc($result)){
				$contagem = $row['registrosContagem'];
				$_SESSION['registrosContagemStr'] = $contagem;
				$contagem = intval($contagem);
				$_SESSION['registrosContagem'] = $contagem; 
        }
    }
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>GATE</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="_src/includes/images/icons/favicon.ico"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="_css/main.css" />
		<link rel="stylesheet" href="_css/index.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
		<noscript><link rel="stylesheet" href="_css/ext/noscript.css" /></noscript>
		<script src="_js/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="_js/sweetalert2/dist/sweetalert2.min.css">
	</head>
	<body class="landing is-preload">


		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<h1><a href="index.php">GATE</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
										<?php
											//caso o usuario faça login aparece isso pra ele
											if(isset($_SESSION['usersNome'])){
											?>
												
												<li><a href="change-password/index.php">Editar cadastro</a></li>
										
												<li><a href="registros/index.php">Caderno de registros</a></li>
												
											<?php
											} 
											if(isset($_SESSION['usersNome']) && $_SESSION['usersTipo'] == "Administrador"){?>

											<li><a href="log/index.php">Caderno de log</a></li>

											<?php } 
											if(isset($_SESSION['usersNome'])){?>
												<ul class="actions stacked">
													<li><a href="_src/includes/logout.inc.php" class="button fit" style="margin-top:30px">Logout</a></li>
												</ul>
											<?php }
											else{
											?>
												<li><a href="signup/index.php">Criar conta</a></li>
												<li><a href="reset-password/index.php">Esqueceu sua senha?</a></li>
												<li><a href="registros/index.php">Caderno de registros</a></li>
											<?php
											}
											?>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Banner -->
					<section id="banner">
						<div class="inner">
							<style>
								.circle{
									display: inline-block;
									border-radius:50%;
									background-position: center;
									background-size: cover;
									width: 180px;
									height: 180px;
								}
								.circle-tiny{
									display: inline-block;
									border-radius:50%;
									background-position: center;
									background-size: cover;
									width: 100px;
									height: 100px;
								}
								.icon1{
									font-size:1.4em;
									position:relative;
									left:34%; bottom:65px;
									transform:translate(-50%, 150%);
									background-image:url('_src/includes/images/banner.jpg');
									padding:0.2em; border:2px solid white;
									border-radius:0.8em;
								}
								@media screen and (max-width: 480px) {
									.circle-tiny{
										display: inline-block;
										border-radius:50%;
										background-position: center;
										background-size: cover;
										width: 75px;
										height: 75px;
									}
									.icon1{
										font-size:1.2em;
										position:relative;
										left:25%; bottom:55px;
										transform:translate(-50%, 150%);
										background-image:url('_src/includes/images/banner.jpg');
										padding:0.2em; border:2px solid white;
										border-radius:0.8em;
									}
									.alert {
									  padding: 20px;
									  background-image: url('_src/includes/images/fundo-vermelho.jpg');
									  position: relative;
									  color: white;
									  
									}

									.closebtn {
									  margin-left: 15px;
									  color: white;
									  font-weight: bold;
									  float: right;
									  font-size: 22px;
									  line-height: 20px;
									  cursor: pointer;
									  transition: 0.3s;
									}

									.closebtn:hover {
									  color: black;
									}

								}
							</style>
							<?php
								if(isset($_SESSION['usersNome'])){
								?>
									<section id="banner2">
										<h2>
											<div class="circle" style="background-image: url('<?php echo "_src/includes/profilepics/".$_SESSION['usersImg']; ?>'); "></div>
											
											<div><?php $usersNome = $_SESSION['usersNome']; $parts = explode(' ', $usersNome); echo $parts[0];?></div>
										</h2>
										<center>
								<?php
									if($_SESSION['usersEstado'] == "Dentro"){
										if($_SESSION['registrosContagem'] == 1){
											if($_SESSION['usersNivel'] == "A"){
								?>
											<form action="_src/includes/reg-fechamento.inc.php" method="post" id="form1" style="margin: 10px 0 !important;">
												<button class="button primary fit" type="submit" name="reg-fechamento-submit">Registrar fechamento</button>
											</form>
								<?php
											} else{ 
												// mude aqui caso usuários comuns não puderem fechar o laboratório
								?>
											<form action="_src/includes/reg-fechamento.inc.php" method="post" id="form1" style="margin: 10px 0 !important;">
												<button class="button primary fit" type="submit" name="reg-fechamento-submit">Registrar fechamento</button>
											</form>
								<?php
											}
									
										} else{
								?>
											<form action="_src/includes/reg-saida.inc.php" method="post" id="form1" style="margin: 10px 0 !important;">
												<button class="button primary fit" type="submit" name="reg-saida-submit">Registrar saída</button>
											</form>
								<?php
										}
									}

									if($_SESSION['usersEstado'] == "Fora"){
										if($_SESSION['registrosContagem'] == 0){
											if($_SESSION['usersNivel'] == "A"){
								?>
											<form action="_src/includes/reg-abertura.inc.php" method="post" id="form1" style="margin: 10px 0 !important;">
												<button class="button primary fit" type="submit" name="reg-abertura-submit">Registrar abertura</button>
											</form>
								<?php
											} else{
								?>
											<form>
												<center>
													<br>
													<p>O laboratório está fechado no momento.</p>
													<br>
												</center>
											</form>
								<?php
											}
										
										} else{
								?>
											<form action="_src/includes/reg-entrada.inc.php" method="post" id="form1" style="margin: 10px 0 !important;">
												<button class="button primary fit" type="submit" name="reg-entrada-submit">Registrar entrada</button>
											</form>
								<?php
										}
									}
								?>

								<?php
									if($_SESSION['usersTipo'] == "Administrador"){
										$query = "SELECT COUNT(*) AS TOTAL FROM users WHERE usersStatusConta = 'ConfAdmin'";
										$result = mysqli_query($conn, $query);
										$row = mysqli_fetch_assoc($result);
										$_SESSION['cadastros'] = $row['TOTAL'];

										if($_SESSION['cadastros'] > 0){
								?>
											<form action="conf-cadastros.php" method="post" id="form1" style="margin: 10px 0 !important;">
												<button class="button primary fit" name="btn-conf-cadastros">Confirmar Cadastros (<?php echo $_SESSION['cadastros'];?>)</button>
											</form>
								<?php
										}
								?>
										<form action="conf-users/index.php" method="post" id="form1" style="margin: 10px 0 !important;">
											<button class="button primary fit" name="btn-conf-users">Gerenciar Usuários</button>
										</form>
								<?php
										if($contagem >= 2){
								?>
										<!----------Botão para registrar a saída ou entrada sla de outros usuários-------->
										<form action="reg-users/index.php" method="post" id="form1" style="margin: 10px 0 !important;">
											<button class="button primary fit" name="btn-reg-users">Registrar outras saídas</button>
										</form>
								<?php
										}
								?>

									</section>
								<?php
									}

								} else{
								?>
									<h2>GATE</h2>
									<center>
										<form action="_src\includes\login.inc.php" id="form1" method="post" autocomplete="off">
											<div class="wrap-input100 validate-input" data-validate = "Insira sua matrícula">
												<input class="input100" type="text" name="matricula" placeholder="Matrícula">
												<span class="symbol-input100">
													<i class="fas fa-id-card-alt" aria-hidden="true"></i>
												</span>
											</div>
											<div class="wrap-input100 validate-input" data-validate = "Insira sua senha">
												<input class="input100" type="password" name="password" placeholder="Senha">
												<span class="symbol-input100">
													<i class="fa fa-lock" aria-hidden="true"></i>
												</span>
											</div>
											<?php
												if(isset($_GET['error']) && $_GET['error']=='nouser'){

											?>
											<div class="alert">
												Matrícula <strong>errada</strong>
												<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
											</div>
											<?php
												}
											?>
											<div class="container-login100-form-btn" style="margin-top:20px;">
												<button class="button fit" type="submit" name="login-submit">Login</button>
											</div>
											<div class="container-login100-form-btn" style="margin-top:10px;">
												<button class="button primary fit" type="submit" name="reg-submit">Registrar Ação</button>
											</div>
											
										</form>
									</center>
								<?php
								}    
								?>
						</div>
						<?php
						if($_SESSION['registrosContagem'] > 0){
						?>
							<a href="#one" class="more scrolly">On-lab</a>
						<?php
						}
						?>		
					</section>
				
					<?php
					if($_SESSION['registrosContagem'] > 0){
					?>
						<!-- One -->
							<section id="one" class="wrapper style1 special">
								<div class="inner">
									<header class="major">
										<h2>On-lab</h2>
										<div style="width:400px;margin:auto;text-align:left;">
											<?php 
												//include our connection
												include_once('_src/dbh/pdo.php');

												$database = new Connection();
												$db = $database->open();

												try{	
													$sql = 'SELECT usersNome, usersImg, usersTipo, usersNivel FROM users WHERE usersEstado="Dentro" ORDER BY usersId DESC';
													
													$result = mysqli_query($conn, $sql);
													$row = mysqli_fetch_array($result);
													foreach ($db->query($sql) as $row) {
														if($row['usersTipo'] == "Administrador"){
															$icon = "fas fa-tools";
														} else if($row['usersNivel'] == "A"){
															$icon = "fas fa-shield-alt";
														} else{
															$icon = "fas fa-user";
														}
											?>
														<div style="margin-top:10px; width: 100%;">
															<!-- icone -->
															<span class="<?php echo $icon; ?> icon1"></span>
															<!-- foto -->
															<div class="circle-tiny" style="background-image: url('<?php echo "_src/includes/profilepics/".$row['usersImg']; ?>'); "></div>
															<!-- nome -->
															<span style="margin-left:10px;font-size:1.5em;position: relative; bottom: 1.4em;"><?php $usersNome = $row['usersNome']; $parts = explode(' ', $usersNome); echo $parts[0].' '.$parts[1];?></span>	
														</div>
											<?php 
													}
												}
												catch(PDOException $e){
													echo "There is some problem in connection: " . $e->getMessage();
												}

												//close connection
												$database->close();
											?>
										</div>
									</header>

								</div>
							</section>
					<?php
					}
					?>

				<!-- Footer -->
					<?php
					require_once('_src/footer.php');
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
				
			<?php
				include_once('swal.php');
			?>

	</body>
</html>