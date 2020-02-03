<div class="modal fade" id="conf-cadastro_<?php echo $row['usersId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width:500px;">
        <div class="modal-content">
            <div class="modal-header">
                <center><h4 class="modal-title" id="myModalLabel">Confirmação de Cadastro</h4></center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="../includes/conf-cadastros.inc.php?usersId=<?php echo $row['usersId']; ?>" autocomplete="off">

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

                        <div class="form-group">
                            <!-- Tipo -->
                            <input type="hidden" class="form-control" name="tipo" value="<?php echo $row['usersTipo']; ?>">
                        </div>

                        <div class="form-group">
                            <!-- Id -->
                            <input type="hidden" class="form-control" name="id" value="<?php echo $row['usersId']; ?>">
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" name="modal-conf-cadastros-submit" class="btn btn-success">Salvar alterações</a>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="modal fade" id="delete-cadastro_<?php echo $row['usersId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
 aria-hidden="true">
	<div class="modal-dialog" style="width:500px;">
		<div class="modal-content">
			<div class="modal-header">
                <center>
					<h4 class="modal-title" id="myModalLabel">Apagar Solicitação de Cadastro</h4>
				</center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<h5 class="text-center">
                    Você tem certeza? Essa ação não pode ser desfeita.
				</h5>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span>
					Cancelar</button>
				<a href="includes/delete-conf-cadastros.inc.php?usersId=<?php echo $row['usersId']; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span>
					Deletar</a>
			</div>

		</div>
	</div>
</div>