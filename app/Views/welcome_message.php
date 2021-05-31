<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LOGIN | IO</title>
	<link rel="manifest" href="<?= base_url() ?>/manifest.webmanifest">
	<link rel="shortcut icon" href="<?= base_url() ?>/dist/img/eletricidade.png" type="image/x-icon">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page img-responsive" style="background-image: url(dist/img/electrical-home.jpg); margin-top: auto; margin-left: auto; margin-right: auto;">
	<div class="login-box">
		<!-- /.login-logo -->
		<div class="card card-outline card-primary">
			<div class="card-header text-center">
			<img class="profile-user-img img-fluid img-circle" src="<?= base_url() ?>/dist/img/eletricidade.png" alt="" srcset="">
			</div>
			<div class="card-body">
				<p class="login-box-msg">
				Login - Obras e Eletricidade
				</p>
				<?php $validation = \Config\Services::validation(); ?>

				<form action="/valida-acesso" method="post">
					<?= csrf_field() ?>
					<label for="email" class="text-danger">Login do usuário:</label>
					<div class="input-group mb-3">
						<input type="email" name="email" class="form-control" placeholder="login pessoal">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<?php if ($validation->getError('email')) { ?>
						<div class='alert alert-danger mt-2'>
							<?= $error = $validation->getError('email'); ?>
						</div>
					<?php } ?>

					<label for="senha" class="text-danger">Senha de acesso:</label>
					<div class="input-group mb-3">
						<input type="password" name="password" class="form-control" placeholder="Senha pessoal">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<?php if ($validation->getError('password')) { ?>
						<div class='alert alert-danger mt-2'>
							<?= $error = $validation->getError('password'); ?>
						</div>
					<?php } ?>

					<div class="form-group">
						<label for="filial" class="text-danger">Sua filial:</label>
						<select name="my_employer" class="custom-select form-control-border border-width-2">
							<option selected disabled>Selecione aqui...</option>
							<?php if (!empty($frentes) && is_array($frentes)) : ?>
								<?php foreach ($frentes as $frentes_tb) : ?>
									<option value="<?= esc($frentes_tb['id_ft']) ?>"><?= esc($frentes_tb['nome_ft']) ?></option>
								<?php endforeach; ?>
							<?php else : ?>
							<?php endif ?>
						</select>
						<?php if ($validation->getError('my_employer')) { ?>
							<div class='alert alert-danger mt-2'>
								<?= $error = $validation->getError('my_employer'); ?>
							</div>
						<?php } ?>
					</div>


					<div class="row">
						<!-- /.col -->
						<div class="col-12">
							<button type="submit" class="btn btn-primary btn-block">
								<i class="fas fa-sign-in-alt mr-2"></i> Entrar
							</button>
						</div>
						<!-- /.col -->
					</div>
				</form>
				<!-- /.social-auth-links -->

				<p class="mb-1">
					<a href="#">Recuperar senha de acesso</a>
				</p>
			</div>
			<!-- /.card-body -->
		</div>
		<!-- /.card -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
</body>

</html>