<!DOCTYPE HTML>
<html>
	<head>
	<title>LPA - Alteração de senha</title>
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="../_src/includes/images/icons/favicon.ico"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../_css/main.css" />
		<link rel="stylesheet" href="../_css/index.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
		<noscript><link rel="stylesheet" href="../_css/ext/noscript.css" /></noscript>
		<script src="_js/sweetalert2/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="_js/sweetalert2/dist/sweetalert2.min.css">
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
						<header>
							<h2>Alteração de senha</h2>
							<!-- <p>Aliquam ut ex ut interdum donec amet imperdiet eleifend</p> -->
						</header>
						<section class="wrapper style5" style="padding: 2em 0 2em 0;">
							<div class="inner">
                                <center>
                                    <p>Um e-mail será enviado para você com as instruções para a alteração da sua senha.</p>
                                </center>
								<center>
									<form action="../_src/includes/reset-request.inc.php" method="post" id="form1" enctype="multipart/form-data" autocomplete="off">
										<div class="wrap-input100 validate-input" data-validate = "Digite seu e-mail">
											<input class="input100" type="text" name="mail" placeholder="E-mail">
											<span class="focus-input100"></span>
											<span class="symbol-input100">
												<i class="fa fa-envelope" aria-hidden="true"></i>
											</span>
										</div>
										<div class="container-login100-form-btn">
											<button  class="button primary fit" type="submit" name="reset-request-submit" style="margin-top:20px;">
												Receber e-mail
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