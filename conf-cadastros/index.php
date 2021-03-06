<?php
    session_start();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>LPA - Cadastros</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
		<link rel="stylesheet" href="../_css/main.css" />
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
									<a href="#menu" class="menuToggle"><span>Menu</span></a>
									<div id="menu">
										<ul>
											<li><a href="index.php">Início</a></li>
										</ul>
									</div>
								</li>
							</ul>
						</nav>
					</header>

				<!-- Main -->
					<article id="main">
						<header>
							<h2>Confirmar Cadastros</h2>
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
                                        <th style="text-align:center;width:30%;">Nome</th>
                                        <th style="text-align:center;width:15%;">Curso</th>
                                        <th style="text-align:center;width:10%;">Data</th>
                                        <th style="text-align:center;width:15%;">Ações</th>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            //include our connection
                                            include_once('../_src/dbh/pdo.php');

                                            $database = new Connection();
                                            $db = $database->open();
                                            try{	
                                                $sql = "SELECT * FROM users WHERE usersStatusConta = 'ConfAdmin' ORDER BY usersId DESC";
                                                foreach ($db->query($sql) as $row) {
                                                    ?>
                                                    <tr>
                                                        <style>
                                                            #circle{ border-radius:50% 50% 50% 50%; height: auto; width: auto;width:55px;height:55px; }
                                                        </style>

                                                        <td style="text-align:center;vertical-align:middle;"><?php echo "<img src='includes/images/" . $row['usersImg'] . "' id='circle'>"; ?></td>
                                                        <td style="text-align:center;vertical-align:middle;"><?php echo $row['usersMatricula']; ?></td>
                                                        <td style="text-align:center;vertical-align:middle;"><?php echo $row['usersNome']; ?></td>
                                                        <td style="text-align:center;vertical-align:middle;"><?php echo $row['usersCurso']; ?></td>
                                                        <?php $time = strtotime($row['usersAddEm']); $myFormatDateForView = date("d/m/Y", $time); ?>
                                                        <td style="text-align:center;vertical-align:middle;"><?php echo $myFormatDateForView; ?></td>
                                                        <td style="text-align:center;vertical-align:middle;"><a href="#conf-cadastro_<?php echo $row['usersId'];?>" class="btn btn-success btn-sm" data-toggle="modal"><i class="fas fa-user-check"></i></a>
                                                        <a href="#delete-cadastro_<?php echo $row['usersId'];?>" class="btn btn-danger btn-sm" data-toggle="modal"><i class="fas fa-user-minus"></i></a></td>
                                                        <?php include('modal-conf-cadastros.php'); ?>
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
			<script src="js/jquery.min.js"></script>
			<script src="js/jquery.scrollex.min.js"></script>
			<script src="js/jquery.scrolly.min.js"></script>
			<script src="js/browser.min.js"></script>
			<script src="js/breakpoints.min.js"></script>
			<script src="js/util.js"></script>
            <script src="js/main.js"></script>
            <script src="js/modal.js"></script>

	</body>
</html>

<?php 
    //} else{
    //    header('location: ../index.php');
    //}
?>