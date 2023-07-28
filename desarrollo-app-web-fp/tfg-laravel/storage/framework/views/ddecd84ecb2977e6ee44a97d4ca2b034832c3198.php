<?php $__env->startSection('title', 'Captive Portal'); ?>

<?php $__env->startSection('head'); ?>

    <script src="<?php echo e(asset('js/captive-portal.js')); ?>" type="text/javascript"></script>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div id="areaForm">

        <div>

            <div id="clientLogo"><div></div></div>

            <div id="formClient" class="ui form">
                
                <div class="field">
                    <label><?php echo app('translator')->getFromJson('captive-portal.form.name.tittle'); ?></label>
                    <div class="ui left icon input">
                        <i class="user icon"></i>
                        <input id="clientName" type="text" name="name" placeholder="<?php echo app('translator')->getFromJson('captive-portal.form.name.placeholder'); ?>">
                    </div>
                </div>
                <div class="field">
                    <label><?php echo app('translator')->getFromJson('captive-portal.form.surname.tittle'); ?></label>
                    <div class="ui left icon input">
                        <i class="user plus icon"></i>
                        <input id="clientSurnames" type="text" name="surname" placeholder="<?php echo app('translator')->getFromJson('captive-portal.form.surname.placeholder'); ?>">
                    </div>
                </div>
                <div class="field">
                    <label><?php echo app('translator')->getFromJson('captive-portal.form.email.tittle'); ?></label>
                    <div class="ui left icon input">
                        <i class="envelope outline icon"></i>
                        <input id="clientEmail" type="text" name="email" placeholder="<?php echo app('translator')->getFromJson('captive-portal.form.email.placeholder'); ?>">
                    </div>
                </div>
                <div class="field">
                    <label><?php echo app('translator')->getFromJson('captive-portal.form.gender.tittle'); ?></label>
                    <div class="ui fluid search selection dropdown">
                        <input id="clientGender" type="hidden" name="gender">
                        <i class="dropdown icon"></i>
                        <div class="default text">
                            <i class="venus mars icon"></i>
                            <?php echo app('translator')->getFromJson('captive-portal.form.gender.placeholder'); ?>
                        </div>
                        <div class="menu" style="max-height: 115px;">
                            <div class="item" data-value="1"><i class="mars icon"></i><?php echo app('translator')->getFromJson('captive-portal.form.gender.types.man'); ?></div>
                            <div class="item" data-value="2"><i class="venus icon"></i><?php echo app('translator')->getFromJson('captive-portal.form.gender.types.woman'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="field">
                    <label><?php echo app('translator')->getFromJson('captive-portal.form.birthdate.tittle'); ?></label>
                    <div class="ui calendar calendarDate left icon input">
                        <i class="calendar icon"></i>
                        <input id="clientBirthdate" type="text" name="birthdate" placeholder="<?php echo app('translator')->getFromJson('captive-portal.form.birthdate.placeholder'); ?>">
                    </div>
                </div>
                <div class="field">
                    <div id="checkboxCoditionsMinor" class="ui checkbox">
                        <input type="checkbox" name="acceptConditionsMinor" tabindex="0">
                        <label><?php echo app('translator')->getFromJson('captive-portal.form.conditions-minor'); ?></label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui checkbox">
                        <input type="checkbox" name="acceptConditions" tabindex="0">
                        <label><?php echo app('translator')->getFromJson('captive-portal.form.conditions'); ?></label>
                    </div>
                </div>
                <button class="ui primary submit button"><?php echo app('translator')->getFromJson('captive-portal.form.submit'); ?></button>
                <button class="ui reset button"><?php echo app('translator')->getFromJson('captive-portal.form.clean'); ?></button>
            </div>

        </div>

    </div> 

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.captive-portal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>