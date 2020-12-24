

<?php $__env->startSection('content'); ?>

    <div class="invoice-wrapper">
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-xs-6 img">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" style="width:50%">
                    </div>
                    <div class="col-xs-6 text-right">
                        <h3 class="ltr"> <?php echo e($invoice->number); ?>#   <?php echo e(__('رقم الفاتوره')); ?> </h3>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-xs-12">
                        <address>
                            <strong><?php echo e(__('Billed To')); ?></strong><br>
                            <?php if($invoice->customer_id): ?>
                                <?php echo e($invoice->customer->name); ?>

                            <?php elseif($invoice->supplier_id): ?>
                                <?php echo e($invoice->supplier->name); ?>

                            <?php endif; ?>
                            <br>
                            <?php if($invoice->customer_id): ?>
                                <?php echo e($invoice->customer->address); ?>

                            <?php elseif($invoice->supplier_id): ?>
                                <?php echo e($invoice->supplier->address); ?>

                            <?php endif; ?>

                        </address>
                        <strong><?php echo e(__('Paid')); ?></strong> <?php echo e($invoice->paid); ?><br>
                        <strong><?php echo e(__('Remaining')); ?></strong> <?php echo e($invoice->remaining); ?>

                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12 pad-top">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo e(__('Order summary')); ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td><strong><?php echo e(__('Item')); ?></strong></td>
                                            <td class="text-center"><strong><?php echo e(__('المقاس')); ?></strong></td>
                                            <td class="text-center"><strong><?php echo e(__('Price')); ?></strong></td>
                                            <td class="text-center"><strong><?php echo e(__('الوزن')); ?></strong></td>
                                            <td class="text-center"><strong><?php echo e(__('Quantity')); ?></strong></td>
                                            <td class="text-center"><strong><?php echo e(__('Total')); ?></strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong><?php echo e(__('Total')); ?></strong></td>
                                            <td class="no-line text-center"><?php echo e($invoice->total); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong><?php echo e(__('Discount')); ?></strong></td>
                                            <td class="no-line text-center"><?php echo e($invoice->discount); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center no-print">
                    <a class="btn btn-primary btn-lg" onClick="jQuery('#page-content').print()">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </div>
        </section>
    </div>




<?php $__env->startSection('scripts'); ?>

    <script>

        $('#table').footable() ;
        $('#table').dataTable( {
            "responsive": false,
            "language": {
                "paginate": {
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "next": '<i class="fa fa-angle-right"></i>'
                }
            }
        } );


    </script>

<?php $__env->stopSection(); ?>

<?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/invoice/purchase/show.blade.php ENDPATH**/ ?>