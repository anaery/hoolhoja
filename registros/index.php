<?php
    session_start();
    include_once '../_src/dbh/pdo.php';
    $_SESSION['conf-cadastro'] = "";
?>

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
									<!-- <a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.php">Início</a></li>
										</ul>
									</div> -->
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<article id="main">
						<header>
							<h2>Caderno de Registros</h2>
							<!-- <p>Aliquam ut ex ut interdum donec amet imperdiet eleifend</p> -->
						</header>
						<section class="wrapper style5" style="padding: 2em 0 2em 0;">
							<div class="inner">
								<section>

									<div>
										<table id="registros" class="table table-bordered table-striped" style="margin-top:20px;">
											<thead>
												<tr>
													<th style="text-align:center;">Data</th>
													<th style="text-align:center;">Hora</th>
                                                    <th style="text-align:center;">Ação</th>
                                                    <th style="text-align:center;">Nome</th>
                                                    <th style="text-align:center;">Matrícula</th>
                                                    <th style="text-align:center;">Contagem</th>
												</tr>
											</thead>
											<tbody>
												<?php 
													//include our connection
													include_once('../_src/dbh/pdo.php');

													$database = new Connection();
													$db = $database->open();
													try{	
														$sql = 'SELECT * FROM registros ORDER BY registrosId DESC';
														foreach ($db->query($sql) as $row) {
															?>
															<tr>
																<?php $time = strtotime($row['registrosData']); $myFormatDateForView = date("d/m/Y", $time); ?>
																<td style="text-align:center;"><?php echo $myFormatDateForView; ?></td>
																<?php $myFormatHourForView = date("H:i:s", $time); ?>
																<td style="text-align:center;"><?php echo $myFormatHourForView; ?></td>
																<td style="text-align:center;"><?php echo $row['registrosRegistro']; ?></td>
																<td style="text-align:center;"><?php echo $row['registrosNome']; ?></td>
																<td style="text-align:center;"><?php echo $row['registrosMatricula']; ?></td>
																<td style="text-align:center;"><?php echo $row['registrosContagem']; ?></td>
															</tr>
															<?php 
														}
													}
													catch(PDOException $e){
														echo "There is some problem in connection: " . $e->getMessage();
													}

													//close connection
													$database->close();

												?>
											</tbody>
                                        </table>
									</div>

									<center>
										<p>Por padão só são exibidos os últimos 50 registros.<br>
										Para ter acesso aos demais registros digite a data desejada abaixo e clique em gerar PDF.</p>

										<form action="includes/pdf-caderno.inc.php" method="post" target="_blank" id="form1" autocomplete="off"  style="width: 13em !important">
											<div class="wrap-input100 validate-input" data-validate = "Insira uma data">
												<input class="input100" name="data" id="dateField" type="text" placeholder="DD/MM/AAAA" pattern="\d{1,2}/\d{1,2}/\d{4}" required="required">
												<span class="symbol-input100">
													<i class="fas fa-calendar" aria-hidden="true"></i>
												</span>
											</div>
											<div class="container-login100-form-btn" style="padding-top: 10px;">
												<button class="button primary fit" type="submit" name="gerarpdf-submit">
													Gerar PDF
												</button>
											</div>
										</form>
									</center>

                                </section>
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

			<script>
				var el = document.getElementById("dateField");
				el.onkeyup = function(evt) {
					if((evt.keyCode >= 48 && evt.keyCode <= 57) || (evt.keyCode >= 96 && evt.keyCode <= 105)) {
					evt = evt || window.event;
					var size = document.getElementById('dateField').value.length;
					if ((size == 2 && document.getElementById('dateField').value > 31)|| (size == 5 && Number(document.getElementById('dateField').value.split('/')[1]) > 12) || (size >= 10 && Number(document.getElementById('dateField').value.split('/')[2]) > 2099)) {
						alert('Data inválida.');
						var a = document.getElementById('dateField').value.split('');
						document.getElementById('dateField').value = a[0] + a[1] + a[2];
						return;
					}
					if ( (size == 2 && document.getElementById('dateField').value < 32) || (size == 5 && Number(document.getElementById('dateField').value.split('/')[1]) < 13)) {
						document.getElementById('dateField').value += '/';     
					}
					if( (size == 5 && document.getElementById('dateField').value.split('')[3] == '/') ){
						var a = document.getElementById('dateField').value.split('');
						document.getElementById('dateField').value = a[0] + a[1] + a[2] + a[4];
					}
					if( (size == 6 && document.getElementById('dateField').value.split('')[3] == '/') ){
						var a = document.getElementById('dateField').value.split('');
						document.getElementById('dateField').value = a[0] + a[1] + a[2] + a[4] + a[5];
					}
					if( (size == 8 && document.getElementById('dateField').value.split('')[6] == '/') ){
						var a = document.getElementById('dateField').value.split('');
						document.getElementById('dateField').value = a[0] + a[1] + a[2] + a[3] + a[4] + a[5] + a[7];
					}
					if( (size == 9 && document.getElementById('dateField').value.split('')[6] == '/') ){
						var a = document.getElementById('dateField').value.split('');
						document.getElementById('dateField').value = a[0] + a[1] + a[2] + a[3] + a[4] + a[5] + a[7] + a[8];
					}
					if( (size == 10 && document.getElementById('dateField').value.split('')[6] == '/') ){
						var a = document.getElementById('dateField').value.split('');
						document.getElementById('dateField').value = a[0] + a[1] + a[2] + a[3] + a[4] + a[5] + a[7] + a[8] + a[9];
					}
					if( (size == 11 && document.getElementById('dateField').value.split('')[6] == '/') ){
						var a = document.getElementById('dateField').value.split('');
						document.getElementById('dateField').value = a[0] + a[1] + a[2] + a[3] + a[4] + a[5] + a[7] + a[8] + a[9] + a[10];
					}
					} else { 
						//alert('Data inválida. Dica: digite apenas números')
						//document.getElementById('dateField').value = '';
					}
				}
			</script>

	</body>
</html>