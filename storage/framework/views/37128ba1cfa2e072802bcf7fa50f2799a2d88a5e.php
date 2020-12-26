 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

    <?php $__env->startSection('title','Sales'); ?>
    <?php $__env->startSection('header'); ?>
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Import vouchers')); ?>

            </h2>
        </div>
        <div class="">
            <a href="<?php echo e(route('imports.create')); ?>" class="btn btn-sm btn-outline-info rounded-0"><i class="fa fa-plus"></i> <?php echo e(__('Create a import voucher')); ?></a>
        </div>
    <?php $__env->stopSection(); ?>

    <div class="panel p-3">
        <div class="panel-heading">
            <form  method="post" action="<?php echo e(route('imports.filter')); ?>">
                <?php echo csrf_field(); ?>
                <div class="col-md-3 form-group">
                    <label><?php echo e(__('From')); ?></label>
                    <input type="date" name="from" class="form-control" style="line-height: 15px" required>
                </div>
                <div class="col-md-3 form-group">
                    <label><?php echo e(__('To')); ?></label>
                    <input type="date" name="to" class="form-control " style="line-height: 15px" required>
                </div>
                <button type="submit" class="btn btn-outline-warning" style="margin-top: 25px;width: 100px;"> <?php echo e(__('filter')); ?></button>
            </form>
        </div>
        <div class="panel-body">
            <table  id="table" class="table table-striped table-bordered text-center no-footer dtr-inline" style="width:100%">
                <thead>
                <tr>
                    <th ><?php echo e(__('Number')); ?></th>
                    <th ><?php echo e(__('Amount')); ?></th>
                    <th ><?php echo e(__('Paid For')); ?></th>
                    <th><?php echo e(__('Import from')); ?></th>
                    <th scope="col"><?php echo e(__('Actions')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($voucher->number); ?></td>
                        <td><?php echo e($voucher->amount); ?></td>
                        <td><?php echo e($voucher->to); ?></td>
                        <td><?php echo e($voucher->paid_for); ?></td>
                        <td>
                            <a href="<?php echo e(route('imports.show', $voucher)); ?>"  class="btn btn-success btn-sm fa fa-eye"></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div>


    <?php $__env->startSection('scripts'); ?>
        <script>
            $('#table').dataTable( {
                "responsive": false,
                "language": {
                    "paginate": {
                        "previous": '<i class="fa fa-angle-left"></i>',
                        "next": '<i class="fa fa-angle-right"></i>'
                    }
                },
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order':[['0','desc']]
            } );
        </script>
    <?php $__env->stopSection(); ?>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/vouchers/imports/index.blade.php ENDPATH**/ ?>