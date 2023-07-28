@extends('layouts.main')
@section('content')
<div id="formulario">
	<div id="login_form">
		<div id="container_form">
			<div id="title">
				<span>Accede a tu área privada.</span>
			</div>
			<div id="language_menu">
				<a class="active" href="#">Español</a>
				<span></span>
				<a href="#">Inglés</a>
			</div>
			<div id="box">
				<form>
					<div class="field">
						<input type="email" name="user" placeholder="Usuario · Correo Electrónico">
						<input type="password" name="pass" placeholder="Contraseña">
					</div>
					<div class="forget">
						<span>¿Ha olvidado su contraseña?</span><br>
						<span>
							Click 
							<a href="#">Aquí</a>
						</span>
					</div>
					<div class="sign_in">
						<input type="submit" value="Acceder" name="send"><br>
						<div class="fb-login-button" data-size="large" data-button-type="login_with" data-auto-logout-link="true" data-use-continue-as="true" onlogin="checkLoginState()"></div>
						<a href="#">¿No tienes cuenta?</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection