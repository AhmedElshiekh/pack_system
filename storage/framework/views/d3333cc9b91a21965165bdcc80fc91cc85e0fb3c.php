 <?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\AppLayout::class, []); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>

    <?php $__env->startSection('title',__('Invoice')); ?>
    <?php $__env->startSection('header'); ?>
        <div class="">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <?php echo e(__("Invoice information")); ?>

            </h2>
        </div>
        <div class="">
            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> <?php echo e(__('Back')); ?></a>
        </div>
    <?php $__env->stopSection(); ?>


    <div class="invoice-wrapper p-15">
        <section class="invoice-container">
            <div class="invoice-inner">
                <div class="row">
                    <div class="col-8 img">
                        
                         <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.authentication-card-logo','data' => ['class' => 'block h-9 w-auto']]); ?>
<?php $component->withName('jet-authentication-card-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'block h-9 w-auto']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
                    </div>
                    <div class="col-4">
                        <h4 class=""> <?php echo e($invoice->number); ?>#  <?php echo e(__('Invoice number')); ?> </h4>
                    </div>
                </div>
                <hr/>
                <div class="row">
                    <div class="col-xs-12">
                        <address>
                            <strong><?php echo e(__('Billed To')); ?> :</strong>
                            <?php if($invoice->customer_id): ?>
                                <?php echo e($invoice->customer->name); ?>

                            <?php elseif($invoice->supplier_id): ?>
                                <?php echo e($invoice->supplier->name); ?>

                            <?php endif; ?>
                            <br>
                            <strong><?php echo e(__('Address')); ?> :</strong>
                            <?php if($invoice->customer_id): ?>
                                <?php echo e($invoice->customer->address); ?>

                            <?php elseif($invoice->supplier_id): ?>
                                <?php echo e($invoice->supplier->address); ?>

                            <?php endif; ?>

                        </address>
                        <strong><?php echo e(__('Paid')); ?></strong> : <?php echo e($invoice->paid); ?><br>
                        <strong><?php echo e(__('Remaining')); ?></strong> : <?php echo e($invoice->remaining); ?>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 py-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo e(__('Order summary')); ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                        <tr>
                                            <td class="text-center"><strong>#</strong></td>
                                            <td class="text-center border"><strong><?php echo e(__('Item')); ?></strong></td>
                                            <td class="text-center border"><strong><?php echo e(__('Price')); ?></strong></td>
                                            <td class="text-center border"><strong><?php echo e(__('weight')); ?></strong></td>
                                            <td class="text-center border"><strong><?php echo e(__('Quantity')); ?></strong></td>
                                            <td class="text-center border"><strong><?php echo e(__('Total')); ?></strong></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td class="border"></td>
                                                    <td class="text-center border"><?php echo e($item->name); ?></td>
                                                    <td class="text-center border"><?php echo e($item->price); ?></td>
                                                    <td class="text-center border"><?php echo e($item->weight); ?></td>
                                                    <td class="text-center border"><?php echo e($item->quantity); ?></td>
                                                    <td class="text-center border"><?php echo e($item->total); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="">
                                                <td class="no-line text-center "><strong><?php echo e(__('Total')); ?></strong></td>
                                                <td></td><td></td><td></td><td></td>
                                                <td class="no-line text-center"><?php echo e($invoice->total); ?></td>
                                            </tr>
                                            <tr>
                                                <td class="no-line text-center "><strong><?php echo e(__('Discount')); ?></strong></td>
                                                <td></td><td></td><td></td><td></td>
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
                    <a class="btn btn-outline-dark px-5 rounded-0" onClick="jQuery('#page-content').print()">
                        <i class="fa fa-print"></i> <?php echo e(__('Print')); ?>

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

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
<?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/invoice/purchase/show.blade.php ENDPATH**/ ?>