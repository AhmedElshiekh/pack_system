
 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <?php $__env->startSection('title',__('Edit Customers')); ?>
    <?php $__env->startSection('header'); ?>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <?php echo e(__('Edit Customers')); ?>

        </h2>
        <div class="">
            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> <?php echo e(__('Cancel')); ?></a>
        </div>
    <?php $__env->stopSection(); ?>

    <div class="panel">
        <div class="panel-heading"></div>
        <!--Block Styled Form -->
        <!--===================================================-->
        <form method="post" action="<?php echo e(route('customer.update',$customer)); ?>"  enctype="multipart/form-data" accept-charset="utf-8">
            <?php echo csrf_field(); ?>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name"><?php echo e(__('Name')); ?></label>
                            <input type="text" class="form-control <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?> "
                                id="name" name="name" value="<?php echo e($customer->name); ?>" required>
                            <?php if($errors->has('name')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('name')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="phone"><?php echo e(__('Phone')); ?></label>
                            <input type="text"  minlength="11" class="form-control <?php echo e($errors->has('phone') ? 'is-invalid' : ''); ?> "
                                id="phone" name="phone" value="<?php echo e($customer->phone); ?>" required>
                            <?php if($errors->has('phone')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('phone')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="address"><?php echo e(__('Address')); ?></label>
                            <input type="text" class="form-control <?php echo e($errors->has('address') ? 'is-invalid' : ''); ?> "
                                id="address" name="address" value="<?php echo e($customer->address); ?>" required>
                            <?php if($errors->has('address')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('address')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="address"><?php echo e(__('Note')); ?></label>
                            <textarea  class="form-control <?php echo e($errors->has('note') ? 'is-invalid' : ''); ?> "
                                    name="note"  ><?php echo e($customer->note); ?></textarea>
                            <?php if($errors->has('note')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('note')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

            </div>
            <div class="panel-body text-right">
                <button class="btn btn-primary my-2" type="submit"><?php echo e(__('Save')); ?></button>
            </div>
        </form>

    </div>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/customers/edit.blade.php ENDPATH**/ ?>