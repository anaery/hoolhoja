<?php
    session_start();
    include_once 'includes/dbh.inc.php';
    $_SESSION['conf-cadastro'] = "";
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>LPA - Criar nova senha</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="css/main.css" />
		<link rel="stylesheet" href="css/signup.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
		<noscript><link rel="stylesheet" href="css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Page Wrapper -->
			<div id="page-wrapper">

				<!-- Header -->
					<header id="header">
						<h1><a href="index.php">LPA</a></h1>
						<nav id="nav">
							<ul>
								<li class="special">
									<a href="index.php"><span>Voltar</span></a>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<article id="main">
						<header>
							<h2>Alteração de senha</h2>
						</header>
						<section class="wrapper style5" style="padding: 2em 0 2em 0;">
							<div class="inner">
								<section>

                                    <?php
                                        if(isset($_GET['selector']) && isset($_GET['validator'])){
                                            $selector = $_GET['selector'];
                                            $validator = $_GET['validator'];
                                            if(empty($selector) || empty($validator)){
                                    ?>
                                                <center>
                                                    <p>Não foi possível validar o seu pedido. Erro: 1.</p>
                                                    <a href="index.php">Voltar para o início</a> 
                                                </center>
                                    <?php
                                            } else {
                                                if(ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false){
                                    ?>
                                                    <form action="includes/reset-password.inc.php" method="post" id="form1" enctype="multipart/form-data" autocomplete="off">
                                                        <input type="hidden" name="selector" value="<?php echo $selector; ?>">
                                                        <input type="hidden" name="validator" value="<?php echo $validator; ?>">
    
                                                        <div class="wrap-input100 validate-input" data-validate = "Insira a nova senha">
                                                            <input class="input100" type="password" name="pwd" placeholder="Nova senha">
                                                            <span class="focus-input100"></span>
                                                            <span class="symbol-input100">
                                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <div class="wrap-input100 validate-input" data-validate = "Repita a nova senha">
                                                            <input class="input100" type="password" name="pwd-repeat" placeholder="Repita a senha">
                                                            <span class="focus-input100"></span>
                                                            <span class="symbol-input100">
                                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                            </span>
                                                        </div>
                                                        <div class="container-login100-form-btn">
                                                            <button  class="login100-form-btn" type="submit" name="reset-password-submit">
                                                                Alterar senha
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <?php
                                                } else {
                                    ?>
                                                    <center>
                                                        <p>Não foi possível validar o seu pedido. Erro: 2.</p>
                                                        <a href="index.php">Voltar para o início</a> 
                                                    </center>
                                    <?php
                                                }
                                            }
                                        } 
                                        
                                        else {
                                    ?>
                                            <center>
                                                <p>Não foi possível validar o seu pedido. Erro: 3.</p>
                                                <a href="index.php">Voltar para o início</a> 
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

		<!-- Scripts -->
			<script src="js/jquery.min.js"></script>
			<script src="js/jquery.scrollex.min.js"></script>
			<script src="js/jquery.scrolly.min.js"></script>
			<script src="js/browser.min.js"></script>
			<script src="js/breakpoints.min.js"></script>
			<script src="js/util.js"></script>
			<script src="js/main.js"></script>

	</body>
</html>