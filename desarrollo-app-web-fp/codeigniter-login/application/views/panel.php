<div id='userstable'>
    <h1 class='border-bottom'>Usuarios</h1>
    <div class='row mb-2>
       <div class='col-md-3 float-left'>
       <form action='/login/pages/login.php' id='srch-form'>
           <div class='input-group-sm input-group-append'>
               <input type='text' class='form-control' placeholder='Introduzca su nombre ...' name='usuario' id='srch-term'>
               <button class='btn btn-primary btn-sm' type='submit'><i class='fa fa-search'></i></button>        
           </div>        
       </form>                
       <div class='float-right ml-3'>   
           <a href='/login/controlador/crearusuario.php' class='btn btn-primary btn-sm'>   
               <i class='fa fa-plus'></i> Crear Usuario   
           </a>   
       </div>
       </div>   
    </div>    
    <table class='table table-bordered table-hover table-striped' id='seeallusers'>
        <thead class='thead-light'>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Contraseña</th>
                <th>Borrar</th>
                <th>Modificar</th>
            </tr>
        </thead>
        <tbody>
            <?=$usuarios?> 
        </tbody>
    </table>