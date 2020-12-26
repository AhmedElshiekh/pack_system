 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

    <?php $__env->startSection('title',__('Customers')); ?>
    <?php $__env->startSection('header'); ?>
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Customers')); ?>

            </h2>
        </div>
        <div class="">
            <a href="<?php echo e(route('customer.create')); ?>" class="btn btn-outline-primary rounded-0"><i class="fa fa-plus"></i> <?php echo e(__('Create Customer')); ?></a>
        </div>
    <?php $__env->stopSection(); ?>

    <div class="panel">
        <div class="panel-body">
            <table  id="table" class="table table-striped table-bordered  no-footer dtr-inline" style="width:100%">
                <thead>
                <tr>
                    <th >#</th>
                    <th ><?php echo e(__('Name')); ?></th>
                    <th ><?php echo e(__('Phone')); ?></th>
                    <th ><?php echo e(__('Address')); ?></th>
                    <th ><?php echo e(__('Paid')); ?></th>
                    <th ><?php echo e(__('Remaining')); ?></th>
                    <th ><?php echo e(__('note')); ?></th>
                    <th scope="col"><?php echo e(__('Actions')); ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($customer->name); ?></td>
                            <td><?php echo e($customer->phone); ?></td>
                            <td><?php echo e($customer->address); ?></td>
                            <td><?php echo e($customer->paid); ?></td>
                            <td><?php echo e($customer->remaining); ?></td>
                            <td><?php echo e($customer->note); ?></td>
                            <td>
                                <a href="<?php echo e(route('customer.edit', $customer)); ?>"  class="btn btn-primary btn-sm fa fa-edit"></a>
                                <a href="<?php echo e(route('customer.show', $customer)); ?>"  class="btn btn-success btn-sm fa fa-eye"></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <br>
        </div>
    </div>

    <?php $__env->startSection('scripts'); ?>
        <script>
            $('#table').dataTable( {
                "responsive": false,
                // info:false,
                // paging:false,
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ],
                'order':[['0','desc']]
            });
        </script>
    <?php $__env->stopSection(); ?>
 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/customers/index.blade.php ENDPATH**/ ?>