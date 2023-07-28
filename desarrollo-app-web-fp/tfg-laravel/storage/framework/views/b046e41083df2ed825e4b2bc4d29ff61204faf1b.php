

<?php $__env->startSection('content'); ?>
    <!--Title-->
    <?php if(session('successcreate')||session('successedit')||session('successrecover')||session('successdel')): ?>
        <div class="col-sm-4 container text-center w34successalert"> 
            <?php if(session('successcreate') == 'ok'): ?>
            <?php echo e(Session::forget('successcreate')); ?>

            <div class="alert alert-success">
                <?php echo app('translator')->getFromJson('tables.successcreate'); ?>
            </div>
            <?php endif; ?>
            <?php if(session('successedit') == 'ok'): ?>
            <?php echo e(Session::forget('successedit')); ?>

            <div id="editdone" class="alert alert-success">
                <?php echo app('translator')->getFromJson('tables.successedit'); ?>
            </div>
            <?php endif; ?>
            <?php if(session('successdel') == 'ok'): ?>
            <?php echo e(Session::forget('successdel')); ?>

            <div id="deldone" class="alert alert-success">
                <?php echo app('translator')->getFromJson('tables.successdel'); ?>
            </div>
            <?php endif; ?>
            <?php if(session('successrecover') == 'ok'): ?>
            <?php echo e(Session::forget('successrecover')); ?>

            <div id="recoverdone" class="alert alert-success">
                <?php echo app('translator')->getFromJson('tables.successrecover'); ?>
            </div>
            <?php endif; ?>
            <script>
                setTimeout(function() {
                    $('.w34successalert').hide();
                }, 5000);
            </script>
        </div>
        
        
    <?php endif; ?>
    
    
    <div class="top_page mt-5">
        <?php if($table == 'Clients' || $table == 'Establishments'): ?>
        <div></div>
        <a href="/show/del/<?php echo e($table); ?><?=isset($client_id)? '/'.$client_id : ''?>"><img src="https://cleanstreets.westminster.gov.uk/wp-content/uploads/2018/08/006-trash-bin.png" alt="recycle bin"></a>
        <?php endif; ?>
        <h1 class="text-center text-uppercase text-primary"><?php echo e($table); ?></h1>
        <hr class="star-dark mb-5 text-primary">
    </div>
    <!--Creación de la tabla-->
    <div class="text-center" id="add">
        <?php if($table != 'Clients'): ?>
            <button class="btn btn-primary" id="backButton" onclick="window.history.go(-1); return false;"><i class="fas fa-arrow-left"></i></button> 
        <?php endif; ?>
        <?php if(isset($perms) && !Auth::user()->isAdmin() && $table != 'Clients' && !str_contains($table, 'Deleted')): ?>
            <?php $__currentLoopData = $perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($p->crear == 1 && Auth::id() === $p->usuarios_id && $table != 'Clientele'): ?>
                    <button class="btn btn-primary" id="addButton" onclick="toggleModal('modaladd<?php echo e($table); ?>')">Add &nbsp;&nbsp;<?php echo e($table); ?></button>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(Auth::user()->isAdmin() && !str_contains($table, 'Deleted') && $table != 'Clientele'): ?>
            <button class="btn btn-primary" id="addButton" onclick="toggleModal('modaladd<?php echo e($table); ?>')">Add &nbsp;&nbsp;<?php echo e($table); ?></button> 
        <?php endif; ?>
    </div> 
    <?php if(isset($data) && !empty($data[0]) && count($data) > 0): ?>
        <table id="myTable" class="display nowrap">
            <thead>
                <tr>
                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th><?php echo e($col); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody> 
                <?php if(Auth::user()->isAdmin()): ?> 
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <?php if(Auth::user()->isAdmin()): ?>
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <td><?php echo e($value->$col); ?></td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <?php if(Auth::user()->isAdmin()): ?>
                            <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                                <?php if(str_contains($table, 'Deleted')): ?>
                                    <td><button class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></button></td>
                                <?php else: ?>
                                    <td><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>
                                <?php endif; ?>
                        <?php endif; ?>    
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php elseif(!Auth::user()->isAdmin()): ?>
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <tr>
                            <?php $__currentLoopData = $perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($table === 'Clients' || $table === 'Deleted Clients'): ?>
                                    <?php if($value->id == $p->client_id): ?>
                                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e($value->$col); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                    <?php if($value->id == $p->client_id and $p->borrar == 1): ?>
                                        <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                                    <?php elseif($value->id == $p->client_id and $p->borrar == 0): ?>
                                        <td></td>
                                    <?php endif; ?>
                                    <?php if($value->id == $p->client_id and $p->editar == 1 ): ?>
                                        <?php if($table === 'Clients'): ?>
                                            <td><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>
                                        <?php elseif($table === 'Deleted Clients'): ?>
                                            <td><button class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></button></td>
                                        <?php endif; ?>
                                    <?php elseif($value->id == $p->client_id and $p->editar == 0): ?>
                                        <td></td>
                                    <?php endif; ?>
                                <?php elseif($table != 'Clients'): ?>
                                    <?php if(Auth::id() == $p->usuarios_id && $client_id == $p->client_id): ?>
                                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td><?php echo e($value->$col); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($client_id == $p->client_id): ?>
                                            <?php if($p->borrar == 1): ?>
                                                <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                                            <?php elseif($p->borrar == 0 ): ?>
                                                <td></td>
                                            <?php endif; ?>
                                            <?php if($p->editar == 1): ?>
                                                <?php if(str_contains($table, 'Deleted')): ?>
                                                    <td><button class="btn btn-sm btn-success"><i class="fa fa-recycle"></i></button></td> 
                                                <?php else: ?>
                                                    <td><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>
                                                <?php endif; ?>
                                            <?php elseif($p->editar == 0): ?>
                                                <td></td>
                                            <?php endif; ?>    
                                        <?php else: ?>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endif; ?>  
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <script>
                    $("#myTable").DataTable({
                        responsive: true
                    });
                </script>
            </tbody>
        </table>
    <?php else: ?>
        <h1 class="text-center mt-5 text-secondary"><?php echo app('translator')->getFromJson('tables.nodata'); ?></h1>
    <?php endif; ?>
    <br><br><br><br><br>
    <?php echo $__env->make('public.w34-login.modals', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>