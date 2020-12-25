<?php $__env->startSection('content'); ?>

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo e(__('Voucher Table')); ?></h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">
            <div class="pad-btm form-inline">
                <div class="row">
                    <div class="col-sm-6 table-toolbar-left">
                        <div class="btn-group">
                            <a href="<?php echo e(route('perishable.create')); ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <form  method="post" action="<?php echo e(route('perishable.filter')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="col-md-3 form-group">
                        <label><?php echo e(__('From')); ?></label>
                        <input type="date" name="from" class="form-control" style="line-height: 15px" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label><?php echo e(__('To')); ?></label>
                        <input type="date" name="to" class="form-control " style="line-height: 15px" required>
                    </div>
                    <button type="submit" class="btn btn-active-default" style="margin-top: 25px;width: 100px;"> <?php echo e(__('filter')); ?></button>
                </form>

            </div>
            <table  id="table" class="table ">
                <thead>
                <tr>
                    <th ><?php echo e(__('Number')); ?></th>
                    <th ><?php echo e(__('Category')); ?></th>
                    <th ><?php echo e(__('Amount')); ?></th>
                    <th ><?php echo e(__('Paid For')); ?></th>
                    <th><?php echo e(__('User')); ?></th>
                    <th><?php echo e(__('To')); ?></th>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['read voucher'])): ?>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($voucher->number); ?></td>
                        <td><?php if($voucher->voucher_cat): ?><?php echo e($voucher->category->name); ?><?php endif; ?></td>
                        <td><?php echo e($voucher->amount); ?></td>
                        <td><?php echo e($voucher->paid_for); ?></td>
                        <td><?php echo e($voucher->user->name); ?></td>
                        <?php if($voucher->supplier_id): ?>
                           <td><?php echo e($voucher->supplier->name); ?></td>
                        <?php elseif($voucher->employee_id): ?>
                            <td><?php echo e($voucher->employee->name); ?></td>
                        <?php else: ?>
                            <td><?php echo e($voucher->for); ?></td>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['read voucher'])): ?>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read voucher')): ?>
                                    <a href="<?php echo e(route('voucher.show', $voucher)); ?>"  class="btn btn-success fa fa-eye"></a>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div>


<?php $__env->stopSection(); ?>

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
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ],
            'order':[['0','desc']]
        } );
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/vouchers/imports/index.blade.php ENDPATH**/ ?>