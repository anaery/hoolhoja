<?php
    session_start();
    if( isset( $_POST['btn-conf-users'] ) || $_SESSION['conf-users'] == "done" ){
?>

<!DOCTYPE HTML>
<!--
	Spectral by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
	<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="../_src/includes/images/icons/favicon.ico"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../_css/main.css" />
		<link rel="stylesheet" href="../_css/index.css" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous" />
		<noscript><link rel="stylesheet" href="../_css/ext/noscript.css" /></noscript>

		<style>
								.circle{
									display: inline-block;
									border-radius:50%;
									background-position: center;
									background-size: cover;
									width: 50px;
									height: 50px;
								}
		</style>

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
							<h2>Gerenciar Usuários</h2>
							<!-- <p>Aliquam ut ex ut interdum donec amet imperdiet eleifend</p> -->
						</header>
						<section class="wrapper style5" style="padding: 2em 0 2em 0;">
							<div class="inner">
								<section>

									<div>
                                    <table id="tabela-conf-cadastros" class="table table-bordered table-striped" style="margin-top:20px;">
                                        <thead>
											<th style="text-align:center;width:15%;">Foto</th>
                                            <th style="text-align:center;width:15%;">Matrícula</th>
                                            <th style="text-align:center;width:22%;">Nome</th>
                                            <th style="text-align:center;width:20%;">Curso</th>
                                            <th style="text-align:center;width:12%;">Nível</th>
                                            <th style="text-align:center;width:16%;">Ações</th>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                //include our connection
                                                include_once('../_src/dbh/pdo.php');

                                                $database = new Connection();
                                                $db = $database->open();
                                                try{	
                                                    $sql = "SELECT * FROM users WHERE usersStatusConta = 'Ativa' ORDER BY usersId DESC";
                                                    foreach ($db->query($sql) as $row) {
                                                        ?>
                                                        <tr>
                                                            <td style="text-align:center;"><div class="circle" style="background-image: url('<?php echo "../_src/includes/profilepics/".$row['usersImg']; ?>'); "></div></td>
															<td style="text-align:center;"><?php echo $row['usersMatricula']; ?></td>                                                            
															<td style="text-align:center;"><?php echo $row['usersNome']; ?></td>
                                                            <td style="text-align:center;"><?php echo $row['usersCurso']; ?></td>
                                                            <td style="text-align:center;"><?php echo $row['usersNivel']; ?></td>
                                                            <td style="text-align:center;">
															 <a href="#info-users_<?php echo $row['usersId'];?>" class="btn btn-success btn-sm" data-toggle="modal"><i class="fas fa-info-circle"></i></a>
                                                             <a href="#conf-users_<?php echo $row['usersId'];?>" class="btn btn-info btn-sm" data-toggle="modal"><i class="fas fa-edit"></i></a>
                                                             <a href="#delete-users_<?php echo $row['usersId'];?>" class="btn btn-danger btn-sm" data-toggle="modal"><i class="fas fa-minus-circle"></i></a>
                                                            </td>
                                                            <?php include('../_src/modals/modal-conf-users.php'); ?>
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
			<script src="../_js/ext/jquery.min.js"></script>
			<script src="../_js/ext/jquery.scrollex.min.js"></script>
			<script src="../_js/ext/jquery.scrolly.min.js"></script>
			<script src="../_js/ext/browser.min.js"></script>
			<script src="../_js/ext/breakpoints.min.js"></script>
			<script src="../_js/util.js"></script>
            <script src="../_js/main.js"></script>
            <script src="../_js/modal.js"></script>

	</body>
</html>

<?php 
    } else{
        header('location: ../index.php');
    }
?>