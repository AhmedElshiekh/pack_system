 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

    <?php $__env->startSection('title',__('Purchase')); ?>
    <?php $__env->startSection('header'); ?>
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__('Purchase')); ?>

            </h2>
        </div>
        <div class="">
            <a href="<?php echo e(route('purchase.create')); ?>" class="btn btn-sm btn-outline-primary rounded-0"><i class="fa fa-plus"></i> <?php echo e(__('Create a purchase invoice')); ?></a>
        </div>
    <?php $__env->stopSection(); ?>

    <div class="panel p-4">
        <div class="panel-heading">
            <form  method="post" action="<?php echo e(route('purchase.filter')); ?>">
                <?php echo csrf_field(); ?>
                <div class="col-md-3 form-group">
                    <label><?php echo e(__('From')); ?></label>
                    <input type="date" name="from" class="form-control" style="line-height: 15px" required>
                </div>
                <div class="col-md-3 form-group">
                    <label><?php echo e(__('To')); ?></label>
                    <input type="date" name="to" class="form-control " style="line-height: 15px" required>
                </div>
                <button type="submit" class="btn btn-outline-success " style=" margin-top: 25px;width: 100px;"> <?php echo e(__('filter')); ?></button>
            </form>
        </div>
        <div class="panel-body">

            <table  id="table" class="table table-striped table-bordered  no-footer dtr-inline" style="width:100%">
                <thead>
                    <tr>
                        <th ><?php echo e(__('#')); ?></th>
                        <th ><?php echo e(__('Number')); ?></th>
                        <th ><?php echo e(__('Supplier')); ?></th>
                        <th ><?php echo e(__('Total')); ?></th>
                        <th ><?php echo e(__('Discount')); ?></th>
                        <th ><?php echo e(__('Paid')); ?></th>
                        <th ><?php echo e(__('Remaining')); ?></th>
                        <th ><?php echo e(__('User')); ?></th>
                        <th ><?php echo e(__('Date')); ?></th>
                        <th ><?php echo e(__('Note')); ?></th>
                        

                            <th scope="col"><?php echo e(__('Actions')); ?></th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($invoice->number); ?></td>
                            <td><?php echo e($invoice->supplier->name); ?></td>
                            <td><?php echo e($invoice->total); ?></td>
                            <td><?php echo e($invoice->discount); ?></td>
                            <td><?php echo e($invoice->paid); ?></td>
                            <td><?php echo e($invoice->remaining); ?></td>
                            <td><?php echo e($invoice->user); ?></td>
                            <td><?php echo e($invoice->created_at->format('d-m-Y')); ?></td>
                            <td><?php echo e($invoice->note); ?></td>
                            <td>
                                <a href="<?php echo e(route('purchase.show', $invoice)); ?>"  class="btn btn-sm btn-success fa fa-eye"></a>
                                <a href="" onclick="removeUser('<?php echo e($invoice->number); ?>','<?php echo e(route('invoice.delete', $invoice)); ?>', event)"  class="btn btn-sm btn-danger fa fa-trash"></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <br>
            
        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div>




    <?php $__env->startSection('scripts'); ?>
    

        <script>
            function removeUser(name, url, e) {
                e.preventDefault();
                swal({
                    title: "<?php echo e(__('Are you sure')); ?>?",
                    text: "<?php echo e(__('You are return')); ?> ( " + name + " )",
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

            // $('#table').footable() ;
            $('#table').dataTable( {
                "responsive": false,
                // paging:false,
                // info:false,
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
<?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/invoice/purchase/index.blade.php ENDPATH**/ ?>