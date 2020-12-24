<?php $__env->startSection('content'); ?>


    <!--===================================================-->

    <div class="invoice-wrapper" >
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-xs-6 img">
                        <img src="<?php echo e(asset('images/logo.png')); ?>" style="width:50%">
                    </div>
                </div>
                <div class=" text-center">
                    <h3 class="ltr"> <?php echo e(__('فاتوره مبيعات رقم')); ?> <?php echo e($invoice->number); ?>#   </h3>
                </div>
                <hr/>
                <div class="row">
                    <div  class="col-xs-12 text-right">
                        <span style="font-size:30px">  <?php echo e(__('استلمنا نحن شركه:')); ?>  </span>
                        <span style="font-size: 20px">  Tarek Pack  </span>

                        <span style="float: left;font-size:20px;text-align:right;position: absolute;right: 500px"><?php echo e(__('بتاريخ:')); ?> <?php echo e($invoice->created_at->format('d/m/Y')); ?> </span>

                    </div>
                </div>

                <div class="purchers">
                    
                    <h3>
                        <?php echo e(__('من السيد:')); ?>

                        <?php if($invoice->customer_id): ?>
                            <?php echo e($invoice->customer->name); ?>

                        <?php elseif($invoice->supplier_id): ?>
                            <?php echo e($invoice->supplier->name); ?>

                        <?php endif; ?>

                    </h3>
                    <h3> <?php echo e(__('مبلغ وقدره:')); ?> <?php echo e($invoice->paid); ?> </h3>
                    <h3> <?php echo e(__('متبقي')); ?> <?php echo e($invoice->remaining); ?> </h3>
                    

                </div>
                <div class="row">
                    <div class="col-md-12 pad-top">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo e(__('مقابل')); ?></h3>
                            </div>
                            <div class="panel-body ">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td><strong><?php echo e(__('Item')); ?></strong></td>
                                            <td class="text-center"><strong><?php echo e(__('سعر القطعه')); ?></strong></td>
                                            <td class="text-center"><strong><?php echo e(__('Quantity')); ?></strong></td>
                                            <td class="text-center"><strong><?php echo e(__('Total')); ?></strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $invoice->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($item->name); ?></td>
                                                <td class="text-center"><?php echo e($item->totalItem); ?></td>
                                                <td class="text-center"><?php echo e($item->pivot->quantity); ?></td>
                                                <td class="text-center"><?php echo e($item->pivot->total); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong><?php echo e(__('Discount')); ?></strong></td>
                                            <td class="no-line text-center"><?php echo e($invoice->discount); ?></td>
                                        </tr>
                                        <tr>
                                            <td class="no-line"></td>
                                            <td class="no-line"></td>
                                            <td class="no-line text-center"><strong><?php echo e(__('Total')); ?></strong></td>
                                            <td class="no-line text-center"><?php echo e($invoice->total); ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="purchers">
                    


                    <h3 class="text-right"><?php echo e(__('الي عنوان:')); ?>

                        <?php if($invoice->customer_id): ?>
                            <?php echo e($invoice->customer->address); ?>

                        <?php elseif($invoice->supplier_id): ?>
                            <?php echo e($invoice->supplier->address); ?>

                        <?php endif; ?>
                    </h3>
                    <?php if($invoice->customer_id): ?>
                    <h3><?php echo e(__('رقم تلفيون العميل:')); ?>

                        <?php echo e($invoice->customer->phone1); ?>


                    </h3>
                    <?php endif; ?>

                </div>
                <div class="clr "></div>

                <div class="text-center no-print">
                    <a class="btn btn-primary btn-lg" onClick="jQuery('#page-content').print()">
                        <i class="fa fa-print"></i> Print
                    </a>
                </div>
            </div>
        </section>
    </div>
    <!--===================================================-->



<?php $__env->stopSection(); ?>

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
        });

    </script>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/invoice/sales/show.blade.php ENDPATH**/ ?>