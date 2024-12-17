<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>wDiscovery</title>


	<?php $this->load->view('include/headerTop') ?>


	<style type="text/css">
		/*Whole Project*/
		body {
			font-family: "Poppins", sans-serif;
			font-weight: 400;
			font-size: 16px;
			line-height: 1.625;
			/*font-weight: bold;*/
		}

		/*Login Screen*/
		.divContent {
			width: 25%;
			margin-top: 100px;
			padding-top: 40px;
			padding-bottom: 40px;
			background-color: white;
			border-radius: 10px;

		}

		#imageLogo {
			text-align: center;
		}

		/*  */

		/* */
		/* */
		/* */

		#cellContent {
			border: 1px solid gray;
			width: 50%;
			height: 150px;
			background-color: white;
		}

		#cellStatus {
			height: 100%;
			width: 20px;
			background-color: green;
			float: left;
		}

		#cellTitle {
			/*float: left;*/
		}

		#cellCenterContent {
			padding-left: 40px;
		}

		#tableContent {
			width: 60%;
			margin: 0 auto;
			height: 120px;
			border-spacing: 20px;
			border-collapse: separate;
		}

		#tableCell {

			height: 100%;
			border: 1px solid gray;
			box-shadow: 5px 5px 10px 1px #BCBCBC;
		}

		#cellRightContent {
			width: 150px;
			height: 100%;
			/*background-color: yellow;*/
			float: right;
		}

		#cellLabelContent {
			font-size: 14px;
			font-weight: bold;
		}

		#cellLabelTitle {
			font-size: 12px;
		}

		#cellLabelMainTitle {
			font-size: 18px;
			font-weight: bold;
		}

		.divOrdenacao {
			/*background-color: red;*/
		}

		.dropdown-toggle {
			font-size: 12px;
		}

		.dropdown-item {
			font-size: 12px;
		}

		.divStatus {
			font-size: 5px;
		}

		.spanTitleLegenda {
			font-size: 10px;
		}

		a:link#aSortingTable {
			text-decoration: none;
			color: gray;
		}

		a:visited#aSortingTable {
			text-decoration: none;
			color: gray;
		}

		a:hover#aSortingTable {
			text-decoration: none;
			color: gray;
		}

		a:active#aSortingTable {
			text-decoration: none;
			color: gray;
		}

		a:link#aWithoutFormation {
			text-decoration: none;
			color: black;
		}

		a:visited#aWithoutFormation {
			text-decoration: none;
			color: black;
		}

		a:hover#aWithoutFormation {
			text-decoration: none;
			color: black;
		}

		a:active#aWithoutFormation {
			text-decoration: none;
			color: black;
		}

		body {
			background-image: url("<?php echo base_url('assets/img/wallpaper.jpg') ?>");
			/*background-color: #cccccc;*/
		}
	</style>


</head>

<body>


	<div class="container-fluid">
		<div class="row">
			<div class="col">
				<img src="<?php echo base_url('assets/img/logoLogin.png') ?>">
			</div>
		</div>
	</div>


	<div class="container-fluid divContent">
		<div class="row">
			<div class="col">

				<div id="imageLogo">

					<img src="<?php echo base_url('assets/img/logoLogin.png') ?>">

				</div>

				<br />
				<!-- <form id="formToSend"> -->
				<!-- <input type="hidden" name="sys" value="OGM"> -->
				<div class="row justify-content-center">
					<div class="col-11">
						<div class="form-group">
							<input type="text" class="form-control" id="email" placeholder="Digite o e-mail" name="LOGIN">
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-11">
						<div class="form-group">
							<input type="password" class="form-control" id="pwd" placeholder="Digite a senha" name="SENHA">
						</div>
					</div>
				</div>

				<div class="row justify-content-center">
					<div class="col-11">
						<!-- <button type="submit" id="submitForm" class="btn btn-primary float-right">Entrar</button> -->
						<button id="submitForm" class="btn btn-primary float-right">Entrar</button>
						<br />
					</div>

				</div>

				<!-- </form> -->
			</div>
		</div>
	</div>

	<?php $this->load->view('include/headerBottom') ?>
	<?php $this->load->view('include/defaults') ?>
	<?php $this->load->view('modal/modalLoginIncorreto') ?>


	<script>
		removeSpinner();

		function btnLoginTapped(data) {

			console.log(data.codigo);
			$.when(fetchUsername(data.codigo)).done(function(r1) {
				saveUserData(data, r1);

				// window.open('<?php echo base_url('home') ?>', '_self');

			});

		}

		function saveUserData(data, userName) {
			var userToken = data.token;
			var userTipoAcesso = data.tipoacesso;
			var userCodigo = data.codigo;
			var userCliente = data.cliente;
			var userLogin = $('#email').val();
			return $.ajax({
				url: "<?php echo base_url(); ?>login/userData",
				method: 'POST',
				data: {
					userToken: userToken,
					userTipoAcesso: userTipoAcesso,
					userCodigo: userCodigo,
					userCliente: userCliente,
					userName: userName,
					userLogin: userLogin
				},
				success: function(data) {
					console.log(data);
					window.open('<?php echo base_url('home') ?>', '_self');
				}
			});
		}

		function fetchUsername(a001_cd_usuario) {
			return $.ajax({
				url: "<?php echo base_url(); ?>login/fetchUsername",
				type: 'POST',
				data: {
					a001_cd_usuario: a001_cd_usuario
				},
				dataType: "text",
				success: function(data) {
					console.log(data);

				},
				error: function(request, status, error) {
					console.log(request.responseText);
				}
			});

		}


		$('#submitForm').click(function() {

			var login = $('#email').val();
			var pwd = $('#pwd').val();

			console.log(login)
			console.log(pwd)

			$.ajax({
				url: "<?php echo base_url(); ?>login/performLogin",
				dataType: 'text',
				type: 'POST',
				data: {
					login: login,
					pwd: pwd
				},
				success: function(data) {
					console.log(data.responseText);
				},
				error: function(x) {
					console.log(x.responseText);
				}

			});


		});


		// $(document).ready(function() {
		// 	$("#formToSend").submit(function(event) {
		// 		event.preventDefault();
		// 		$.ajax({
		// 			url: "https://www.wdiscovery.com.br/OGM/wsAutenticaUsuario.rule",
		// 			type: 'POST',
		// 			data: $(this).serialize(),
		// 			dataType: 'json',
		// 			beforeSend: function(xhr) {
		// 				if (xhr.overrideMimeType) {
		// 					xhr.overrideMimeType("application/json");
		// 				}
		// 			},
		// 			success: function(data) {
		// 				console.log(data);
		// 				console.log(data.login);

		// 				if (data.login == true) {
		// 					btnLoginTapped(data);
		// 				} else {
		// 					$("#modalLoginIncorreto").modal("show");
		// 				}
		// 			}
		// 		});
		// 	});
		// });
	</script>
</body>

</html>