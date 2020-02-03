<!-- edit -->
<div class="modal fade" id="conf-users_<?php echo $row['usersId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <center><h4 class="modal-title" id="myModalLabel">Confirmação de Cadastro</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="../includes/conf-users.inc.php?usersId=<?php echo $row['usersId']; ?>" autocomplete="off">

                        <div class="form-group">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome" value="<?php echo $row['usersNome']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Matrícula</label>
                            <input type="text" class="form-control" name="matricula" value="<?php echo $row['usersMatricula']; ?>">
                        </div>

                        <div class="form-group">
                            <label>E-mail</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $row['usersEmail']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Curso</label>
                            <input type="text" class="form-control" name="curso" value="<?php echo $row['usersCurso']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Nível</label>
                            <input type="text" class="form-control" name="nivel" value="<?php echo $row['usersNivel']; ?>">
                        </div>

                        <div class="form-group">
                            <label>MAC</label>
                            <input type="text" class="form-control" name="mac" value="<?php echo $row['usersMac']; ?>">
                        </div>

                        <div class="form-group">
                            <label>Validade</label>
                            <input type="text" class="form-control" name="validade" value="<?php echo $row['usersValidade']; ?>">
                        </div>

                        <div class="form-group">
                            <!-- Senha -->
                            <input type="hidden" class="form-control" name="senha" value="<?php echo $row['usersSenha']; ?>">
                        </div>

                        <div class="form-group">
                            <!-- Imagem -->
                            <input type="hidden" class="form-control" name="img" value="<?php echo $row['usersImg']; ?>">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="modal-conf-users-submit" class="btn btn-success">Salvar alterações</a>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<!-- delete -->
<div class="modal fade" id="delete-users_<?php echo $row['usersId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
 aria-hidden="true">
	<div class="modal-dialog" style="width:500px;">
		<div class="modal-content">
			<div class="modal-header">
                <center>
					<h4 class="modal-title" id="myModalLabel">Remover Usuário</h4>
				</center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form action="../includes/delete-conf-users.inc.php?usersId=<?php echo $row['usersId']; ?>" method="POST">
				<div class="modal-body">
					<h5 class="text-center">
						Você tem certeza? Essa ação não pode ser desfeita.
					</h5>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-default" href="">Confirmar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- info -->
<div class="modal fade" id="info-users_<?php echo $row['usersId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog" style="width:500px;">
		<div class="modal-content">
			<div class="modal-header">
                <center><h4 class="modal-title" id="myModalLabel">Informações do Usuário</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<div class="container-fluid">
					<form method="GET" action="info.php?id=<?php echo $row['usersId']; ?>">
					<div class="row form-group">
					        <div class="col-sm-4">
							    <label >Matrícula</label>
					        </div>
					        <div class="col-sm-8">
							    <p><?php echo $row['usersMatricula']; ?></p>
					        </div>
						</div>
						
						<div class="row form-group">
					        <div class="col-sm-4">
							    <label >Nome</label>
					        </div>
					        <div class="col-sm-8">
							    <p><?php echo $row['usersNome']; ?></p>
					        </div>
				        </div>

                        <div class="row form-group">
					        <div class="col-sm-4">
							    <label >Curso</label>
					        </div>
					        <div class="col-sm-8">
							    <p><?php echo $row['usersCurso']; ?></p>
					        </div>
				        </div>

                        <div class="row form-group">
					        <div class="col-sm-4">
							    <label >Nível</label>
					        </div>
					        <div class="col-sm-8">
							    <p><?php echo $row['usersNivel']; ?></p>
					        </div>
				        </div>

                        <div class="row form-group">
					        <div class="col-sm-4">
							    <label >E-mail</label>
					        </div>
					        <div class="col-sm-8">
							    <p><?php echo $row['usersEmail']; ?></p>
					        </div>
				        </div>

                        <div class="row form-group">
					        <div class="col-sm-4">
							    <label >MAC</label>
					        </div>
					        <div class="col-sm-8">
							    <p><?php echo $row['usersMac']; ?></p>
					        </div>
				        </div>

                        <div class="row form-group">
					        <div class="col-sm-4">
							    <label >Adicionado por</label>
					        </div>
					        <div class="col-sm-8">
							    <p><?php echo $row['usersAddPor']; ?></p>
					        </div>
				        </div>
						
						<div class="row form-group">
					        <div class="col-sm-4">
							    <label >Adicionado em</label>
					        </div>
					        <div class="col-sm-8">
							    <?php $time = strtotime($row['usersAddEm']);$myFormatForView = date("d/m/Y H:i:s", $time);?>
							    <p><?php echo $myFormatForView; ?></p>
					        </div>
				        </div>

                        <div class="row form-group">
					        <div class="col-sm-4">
							    <label >Validade</label>
					        </div>
					        <div class="col-sm-8">
							    <?php $time = strtotime($row['usersValidade']);$myFormatForView = date("d/m/Y", $time);?>
							    <p><?php echo $myFormatForView; ?></p>
					        </div>
				        </div>

                        <div class="row form-group">
					        <div class="col-sm-4">
							    <label >Tipo de usuário</label>
					        </div>
					        <div class="col-sm-8">
							    <p><?php echo $row['usersTipo']; ?></p>
					        </div>
				        </div>

                  	</form>
				</div>
			</div>
		</div>
	</div>
</div>
