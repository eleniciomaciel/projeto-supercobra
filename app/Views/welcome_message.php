<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AdminLTE 3 | Log in (v2)</title>

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
				<a href="index2.html" class="h1"><b>System</b>SNAKE</a>
			</div>
			<div class="card-body">
				<p class="login-box-msg">Sign in to start your session</p>

				<form action="index3.html" method="post">

					<label for="email">Login do usuário:</label>
					<div class="input-group mb-3">
						<input type="email" class="form-control" placeholder="login pessoal">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>

					<label for="senha">Senha de acesso:</label>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="Senha pessoal">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="exampleSelectBorderWidth2">Sua filial</label>
						<select class="custom-select form-control-border border-width-2" id="exampleSelectBorderWidth2">
							<option selected disabled>Selecione aqui...</option>
							<option>Value 2</option>
							<option>Value 3</option>
						</select>
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
					<a href="/admin-panel">Recuperar senha de acesso</a>
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