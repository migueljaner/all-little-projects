<div class="modal" id="modaladd<?php echo e($table); ?>">
    <div class="modal-dialog">
    <form action="/add/<?php echo e($table); ?><?=isset($client_id)?'/'.$client_id : '' ?>" method='post'>
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
                                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($col == 'id'): ?>
                                            <?php continue; ?>
                                        <?php endif; ?>
                                        <?php if($col =='client_id'): ?>
                                            <?php continue; ?>
                                        <?php endif; ?>
                                        <?php if($col == 'guid'): ?>
                                            <?php continue; ?>
                                        <?php endif; ?>
                                        <?php if($col == 'categori_type'): ?>
                                            <tr>
                                                <th class="pb-0"><?php echo e($col); ?></th>
                                                <td>
                                                    <select class="browser-default custom-select" name="<?php echo e($col); ?>">
                                                        <option value="0" disabled selected>Select one ...</option>
                                                        <option value="1">Hotel</option>
                                                        <option value="2">Restaurant</option>
                                                        <option value="3">Beach Club</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <tr> 
                                                <th class="pb-0"><?php echo e($col); ?></th>
                                                <td><input type="text" name="<?php echo e($col); ?>" class="align-middle allinput" maxlength="36" required></td>
                                            </tr>
                                        <?php endif; ?>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<div class="modal" id="modalEdit">
    <div class="modal-dialog">
    <form action="/update/<?php echo e($table); ?>" method="post">
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
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $col): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($col == 'id'): ?>
                                        <?php continue; ?>
                                    <?php endif; ?>
                                    <?php if($col =='client_id'): ?>
                                        <?php continue; ?>
                                    <?php endif; ?>
                                    <?php if($col == 'guid'): ?>
                                        <?php continue; ?>
                                    <?php endif; ?>
                                    <?php if($col == 'categori_type'): ?>
                                        <tr>
                                            <th class="pb-0"><?php echo e($col); ?></th>
                                            <td>
                                                <select class="browser-default custom-select" name="<?php echo e($col); ?>">
                                                    <option value="0" disabled>Select one ...</option>
                                                    <option value="1">Hotel</option>
                                                    <option value="2">Restaurant</option>
                                                    <option value="3">Beach Club</option>
                                                </select>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <tr> 
                                            <th class="pb-0"><?php echo e($col); ?></th>
                                            <td><input type="text" name="<?php echo e($col); ?>" class="align-middle allinput" maxlength="36" required></td>
                                        </tr>
                                     <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

<div id="modalDelete" class="modal">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header text-center pb-0">
                <?php if(str_contains($table, 'Deleted')): ?>	
                <h4 class="modal-title text-danger px-4">Are you sure you want to delete it permanently?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <?php else: ?>
                <h4 class="modal-title text-danger px-4">Are you sure you want to delete it?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <?php endif; ?>
            </div>
            <div class="modal-body text-center">
                <div class="icon-box">
                    <img src="https://image.flaticon.com/icons/svg/53/53639.svg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger ml-4">Delete</button>
            </div>
        </div>
    </div>
</div>

<div id="modalRecover" class="modal">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header text-center pb-0">			
                <h4 class="modal-title text-success px-4">Are you sure you want to recover it?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body text-center">
                <div class="icon-box">
                    <img src="https://image.flaticon.com/icons/svg/46/46080.svg">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success ml-4">Recover</button>
            </div>
        </div>
    </div>
</div>
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