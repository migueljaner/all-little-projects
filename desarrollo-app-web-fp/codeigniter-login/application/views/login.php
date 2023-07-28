    <div class="container">
        <div class="col-sm-4 m-auto text-center">
            <h1>Iniciar Sesión</h1>
            <form action="/Login/Login" method="post">
            <!--Formulario de login-->
            <div class="formgroup m-2">
                <span>Nombre:</span>
                <input type="text" name="usuario" required>
            </div>
            <div class="form-group m-2">
                <span>Contraseña:</span>
                <input type="password" name="clave" required>
            </div>
            <input type="submit" value="Iniciar Sesión" class="btn btn-primary" id="inicio">
            </form>
        </div>
    </div>            
   