 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

    <?php $__env->startSection('title',__('Customer')); ?>
    <?php $__env->startSection('header'); ?>
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__("Customer information")); ?>

            </h2>
        </div>
        <div class="">
            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> <?php echo e(__('Back')); ?></a>
        </div>
    <?php $__env->stopSection(); ?>
    
    <div class="py-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="panel">
                <div class="panel-heading text-center">
                    <h4><?php echo e(__("Main info")); ?></h4>
                </div>
                <!--Data Table-->
                <!--===================================================-->
                <div class="bg-white overflow-hidden border-double border-4 border-light-blue-500">
                    <div class="panel-body">
                        <table  id="" class="table ">
                            <thead>
                                <tr>
                                    <th ><?php echo e(__('Name')); ?></th>
                                    <th ><?php echo e(__('Email')); ?></th>
                                    <th ><?php echo e(__('Phone1')); ?></th>
                                    <th ><?php echo e(__('Phone2')); ?></th>
                                    <th ><?php echo e(__('WhatsApp')); ?></th>
                                    <th ><?php echo e(__('Address')); ?></th>
                                    <th ><?php echo e(__('الاجمالي')); ?></th>
                                    <th ><?php echo e(__('Paid')); ?></th>
                                    <th ><?php echo e(__('Remaining')); ?></th>
                                    <th scope="col"><?php echo e(__('Actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo e($customer->name); ?></td>
                                    <td><?php echo e($customer->email); ?></td>
                                    <td><?php echo e($customer->phone1); ?></td>
                                    <td><?php echo e($customer->phone2); ?></td>
                                    <td><?php echo e($customer->whatsApp); ?></td>
                                    <td><?php echo e($customer->address); ?></td>
                                    <td><?php echo e($customer->paid + $customer->remaining); ?></td>
                                    <td><?php echo e($customer->paid); ?></td>
                                    <td><?php echo e($customer->remaining); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('customer.edit', $customer)); ?>"  class="btn btn-primary fa fa-edit"></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->
            </div>
        </div>
    </div>
    <div class="py-10 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo e(__('Sale invoices')); ?></h3>
                </div>
                <!--Data Table-->
                <!--===================================================-->
                <div class="bg-white overflow-hidden border-double border-4 border-light-blue-500">
                    <div class="panel-body">

                        <table  id="table" class="table ">
                            <thead>
                            <tr>
                                <th ><?php echo e(__('Number')); ?></th>
                                <th ><?php echo e(__('Payment')); ?></th>
                                <th ><?php echo e(__('Total')); ?></th>
                                <th ><?php echo e(__('Discount')); ?></th>
                                <th ><?php echo e(__('Paid')); ?></th>
                                <th ><?php echo e(__('Remaining')); ?></th>
                                <th ><?php echo e(__('User')); ?></th>
                                <th ><?php echo e(__('Date')); ?></th>
                                <th ><?php echo e(__('Note')); ?></th>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['update invoice', 'delete invoice'])): ?>
                                    <th scope="col"><?php echo e(__('Actions')); ?></th>
                                <?php endif; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $customer->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr <?php if($invoice->return): ?>style="text-decoration: line-through"<?php endif; ?>>
                                    <td><?php echo e($invoice->number); ?></td>
                                    <td><?php echo e($invoice->payment); ?></td>
                                    <td><?php echo e($invoice->total); ?></td>
                                    <td><?php echo e($invoice->discount); ?></td>
                                    <td><?php echo e($invoice->paid); ?></td>
                                    <td><?php echo e($invoice->remaining); ?></td>
                                    <td><?php echo e($invoice->user->name); ?></td>
                                    <td><?php echo e($invoice->created_at->format('d-m-Y')); ?></td>
                                    <td><?php echo e($invoice->note); ?></td>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['update invoice', 'read invoice'])): ?>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read invoice')): ?>
                                                <a href="<?php echo e(route('invoice.sales.show', $invoice)); ?>"  class="btn btn-success fa fa-eye"></a>

                                            <?php endif; ?>
                                            <?php if($invoice->return ==0 ): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update invoice')): ?>
                                                    <a href="" onclick="removeUser('<?php echo e($invoice->number); ?>', '<?php echo e(route('invoice.sales.return', $invoice)); ?>', event)"  class="btn btn-danger"><?php echo e(__('return')); ?></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!--===================================================-->
                <!--End Data Table-->
            </div>
        </div>
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
            $('.table').dataTable( {
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
            function editData(name,email,phone,note,href,event) {
                let modal = $('#editDataModal');
                modal.find('.modal-body input[name="name"]').val(name);
                modal.find('.modal-body input[name="email"]').val(email);
                modal.find('.modal-body input[name="phone"]').val(phone);
                modal.find('.modal-body input[name="note"]').val(note);
                modal.find('.modal-body form').attr("action", href);

            };
        </script>

    <?php $__env->stopSection(); ?>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/customers/show.blade.php ENDPATH**/ ?>