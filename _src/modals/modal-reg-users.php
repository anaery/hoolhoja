
<!-- delete -->
<div class="modal fade" id="reg-users_<?php echo $row['usersId']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
 aria-hidden="true" style="padding-top: 50px;">
	<div class="modal-dialog" style="width:500px;">
		<div class="modal-content">
			<div class="modal-header">
                <center>
					<h4 class="modal-title" id="myModalLabel">Cancelar Registro</h4>
				</center>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form action="../includes/reg-users.inc.php?usersId=<?php echo $row['usersId'];?>" method="POST">
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
