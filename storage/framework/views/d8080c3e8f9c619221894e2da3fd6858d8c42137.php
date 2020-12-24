<?php $__env->startSection('title',__('Customer')); ?>

<?php $__env->startSection('content'); ?>

    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo e($customer->name); ?></h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">










            <table  id="table" class="table ">
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
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['update supplier', 'delete supplier'])): ?>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                    <?php endif; ?>
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
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['update supplier'])): ?>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update supplier')): ?>
                                    <a href="<?php echo e(route('customer.edit', $customer)); ?>"  class="btn btn-primary fa fa-edit"></a>
                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    </tr>
                </tbody>
            </table>

        </div>
        <!--===================================================-->
        <!--End Data Table-->
    </div>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo e(__('الفواتير')); ?></h3>
        </div>
        <!--Data Table-->
        <!--===================================================-->
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
        <!--===================================================-->
        <!--End Data Table-->
    </div>
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><?php echo e(__('السندات')); ?></span>

        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">

            <table  id="table3" class="table ">
                <thead>
                <tr>
                    <th ><?php echo e(__('Number')); ?></th>
                    <th ><?php echo e(__('Amount')); ?></th>
                    <th ><?php echo e(__('Paid For')); ?></th>
                    <th><?php echo e(__('User')); ?></th>
                    <th><?php echo e(__('التاريخ')); ?></th>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['read voucher'])): ?>
                        <th scope="col"><?php echo e(__('Actions')); ?></th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $customer->vouchers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $voucher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($voucher->number); ?></td>
                        <td><?php echo e($voucher->amount); ?></td>
                        <td><?php echo e($voucher->paid_for); ?></td>
                        <td><?php echo e($voucher->user->name); ?></td>
                        <td><?php echo e($voucher->created_at->format('Y-m-d')); ?></td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['read voucher'])): ?>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read voucher')): ?>
                                    <a href="<?php echo e(route('voucher.sales.show', $voucher)); ?>"  class="btn btn-success fa fa-eye"></a>
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
    <div class="panel">
        <div class="panel-heading">
            <span class="panel-title"><?php echo e(__('الهوالك')); ?></span>
            <span class="panel-title pull-left"><?php echo e(__('اجمالي الوزن').':'. $customer->perishables->sum('weight')); ?></span>
            <span class="panel-title pull-left"><?php echo e(__('اجمالي العدد').':'. $customer->perishables->sum('number')); ?></span>
            <span class="panel-title pull-left"><?php echo e(__('اجمالي السعر').':'. $customer->perishables->sum('total')); ?></span>

        </div>
        <!--Data Table-->
        <!--===================================================-->
        <div class="panel-body">

            <table  id="table3" class="table ">
                <thead>
                <tr>
                    <th ><?php echo e(__('#')); ?></th>
                    <th ><?php echo e(__('نوع الهالك')); ?></th>
                    <th ><?php echo e(__('العدد/الوزن')); ?></th>
                    <th><?php echo e(__('سعر الوحده')); ?></th>
                    <th><?php echo e(__('الاجمالي')); ?></th>
                    <th><?php echo e(__('التاريخ')); ?></th>

                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $customer->perishables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perishable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($perishable->id); ?></td>
                        <td><?php echo e($perishable->type->name); ?></td>
                        <td><?php echo e($perishable->number? $perishable->number:$perishable->weight); ?></td>
                        <td><?php echo e($perishable->unit_price); ?></td>
                        <td><?php echo e($perishable->total); ?></td>
                        <td><?php echo e($perishable->created_at->format('Y-m-d')); ?></td>

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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/customers/show.blade.php ENDPATH**/ ?>