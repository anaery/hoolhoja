<?php
				if(isset($_GET['error'])){
					if($_GET['error'] == 'loginfirst'){
						?>
							<script>
								Swal.fire({
									/* position: 'top-start', */
									title: 'Atenção',
									text: "Você precisa fazer login para executar essa ação",
									type: 'warning',
									showConfirmButton: false,
									timer: 10000,
									showCloseButton: true
									/* desfocar o fundo */
								})
							</script>
						<?php
					}
				}
			?>

			<?php
				if(isset($_GET['reg-entrada1'])){
					if($_GET['reg-entrada1'] == 'success'){
						?>
							<script>
								Swal.fire({
									/* position: 'top-start', */
									type: 'success',
									title: 'Tudo certo!',
									text: 'Registro de entrada realizado com sucesso',
									showConfirmButton: false,
									timer: 10000,
									showCloseButton: true
									/* desfocar o fundo */
								})
							</script>
						<?php
					}
				}
			?>
			
			<?php
				if(isset($_GET['reg-saida1'])){
					if($_GET['reg-saida1'] == 'success'){
						?>
							<script>
								Swal.fire({
									type: 'success',
									title: 'Tudo certo!',
									text: 'Registro de saída realizado com sucesso',
									showConfirmButton: false,
									timer: 10000,
									showCloseButton: true
									/* desfocar o fundo */
								})
							</script>
						<?php
					}
				}
			?>
			
			<?php
				if(isset($_GET['signup'])){
					if($_GET['signup'] == 'success'){
						?>
							<script>
								Swal.fire({
									type: 'success',
									title: 'Tudo certo!',
									text: 'Confirme seu e-mail para continuar com o cadastro',
									showConfirmButton: false,
									timer: 10000,
									showCloseButton: true
									/* desfocar o fundo */
								})
							</script>
						<?php
					}
				}
			?>

			<?php
				if(isset($_GET['resetrequest'])){
					if($_GET['resetrequest'] == 'success'){
						?>
							<script>
								Swal.fire({
									type: 'success',
									title: 'Tudo certo!',
									text: 'Confira seu e-mail para continuar',
									showConfirmButton: false,
									showCloseButton: true
									/* desfocar o fundo */
								})
							</script>
						<?php
					}
				}
			?>

			<?php
				if(isset($_GET['newpwd'])){
					if($_GET['newpwd'] == 'passwordupdated'){
						?>
							<script>
								Swal.fire({
									type: 'success',
									title: 'Prontinho!',
									text: 'Sua senha foi atualizada com sucesso',
									showConfirmButton: false,
									showCloseButton: true
									/* desfocar o fundo */
								})
							</script>
						<?php
					}
				}
			?>