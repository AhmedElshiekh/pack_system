 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

    <?php $__env->startSection('title',__('Suppliers')); ?>
    <?php $__env->startSection('header'); ?>
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Suppliers')); ?>

            </h2>
        </div>
        <div class="">
            <a href="<?php echo e(route('supplier.create')); ?>" class="btn btn-outline-primary rounded-0"><i class="fa fa-plus"></i> <?php echo e(__('Create supplier')); ?></a>
        </div>
    <?php $__env->stopSection(); ?>


    <div class="panel-body">
        <table  id="table" class="table text-center table-striped table-bordered " style="width:100%">
            <thead class="text-center">
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
                <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loop->iteration); ?></td>
                        <td><?php echo e($supplier->name); ?></td>
                        <td><?php echo e($supplier->phone); ?></td>
                        <td><?php echo e($supplier->address); ?></td>
                        <td><?php echo e($supplier->paid); ?></td>
                        <td><?php echo e($supplier->remaining); ?></td>
                        <td><?php echo e($supplier->note); ?></td>
                        <td>
                            <a href="<?php echo e(route('supplier.edit', $supplier)); ?>"  class="btn btn-sm btn-primary fa fa-edit"></a>
                            <a href="<?php echo e(route('supplier.show', $supplier)); ?>"  class="btn btn-sm btn-success fa fa-eye"></a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <br>
    </div>


    <?php $__env->startSection('scripts'); ?>
        <script>
            function removeUser(name, url, e) {
                e.preventDefault();
                swal({
                    title: "<?php echo e(__('Are you sure')); ?>?",
                    text: "<?php echo e(__('You are deleting')); ?> ( " + name + " )",
                    // icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: '<?php echo e(__('Yes, I am sure!')); ?>',
                    cancelButtonText: "<?php echo e(__('No, cancel it')); ?>"
                }).then(
                    function (obj) {
                        // if (obj.value) {
                            window.location = url;
                        // }
                    }
                );
            }

            $('#table').dataTable( {
                "scrollX": true,
                "responsive": false,
                // info:false,
                // paging:false,
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


<?php /**PATH C:\Websites\bussiness31\carton_v2\resources\views/suppliers/index.blade.php ENDPATH**/ ?>