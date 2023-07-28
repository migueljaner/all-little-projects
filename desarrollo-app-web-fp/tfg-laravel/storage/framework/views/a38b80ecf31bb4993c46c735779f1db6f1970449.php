

<?php $__env->startSection('content'); ?>
    <div class="top_page mt-5">
        <h1 class="text-center text-uppercase text-primary"><?php echo e($table); ?></h1>
        <hr class="star-dark mb-5 text-primary">
    </div>
    <div class="text-center" id="add">
        <?php if(Auth::user()->isAdmin()): ?>
            <button class="btn btn-primary" id="addButton" onclick="toggleModal('modaladd<?php echo e($table); ?>')">Add &nbsp;&nbsp;<?php echo e($table); ?></button>
        <?php endif; ?>         
    </div> 
    <table id="myTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <?php if(Auth::user()->isAdmin()): ?>
                    <th></th>
                    <th></th>       
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($value->id); ?></td>
                    <td><?php echo e($value->name); ?></td>
                    <?php if(Auth::user()->isAdmin()): ?>
                        <td><button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>
                        <td><button class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>          
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <script>
        $('#myTable').dataTable();
    </script>
    <div class="modal" id="modaladd<?php echo e($table); ?>">
            <div class="modal-dialog">
            <form action="/add/<?php echo e($table); ?>" method='post'>
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <h4 class="modal-title text-primary text-uppercase ml-1 mt-2">Add <?php echo e($table); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body pt-2 pb-0">
                        <hr class="separator text-primary">
                        <div class="container mb-4 text-secondary">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="addTable">
                                        <tbody>
                                        <?php echo csrf_field(); ?>
                                            <tr> 
                                                <th class="pb-0">Name</th>
                                                <td><input type="text" name="name" class="align-middle allinput" maxlength="36" required></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div id="modalDelete" class="modal">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header text-center pb-0">
                        <h4 class="modal-title text-danger px-4">Are you sure you want to delete it?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>   
                    </div>
                    <div class="modal-body text-center">
                        <div class="icon-box">
                            <img src="https://image.flaticon.com/icons/svg/53/53639.svg">
                        </div>
                    </div>
                    <div class="modal-body text-center">
                        <select name="changefor">
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger ml-4">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modalEdit">
            <div class="modal-dialog">
            <form action="/update/<?php echo e($table); ?>" method='post'>
                <div class="modal-content">
                    <div class="modal-header border-0 pb-0">
                        <h4 class="modal-title text-primary text-uppercase ml-1 mt-2">Edit <?php echo e($table); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body pt-2 pb-0">
                        <hr class="separator text-primary">
                        <div class="container mb-4 text-secondary">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="addTable">
                                        <tbody>
                                        <?php echo csrf_field(); ?>
                                            <tr> 
                                                <th class="pb-0">Name</th>
                                                <td><input type="text" name="name" class="align-middle allinput" maxlength="36" required></td>
                                            </tr>
                                            <tr style="display: none;">
                                                <td><input type="hidden" name="id" class="align-middle allinput"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer pt-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-block">Confirm</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>