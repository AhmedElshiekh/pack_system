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
                <?php echo e(__('New Sales invoice')); ?>

            </h2>
        </div>
        <div class="">
            <a href="<?php echo e(URL::previous()); ?>" class="btn btn-sm btn-outline-secondary rounded-0"><i class="fa fa-arrow-left"></i> <?php echo e(__('Cancel')); ?></a>
        </div>
    <?php $__env->stopSection(); ?>

    <div class="panel">
        <div class="panel-heading"> </div>
        <form method="post" action="<?php echo e(route('sales.store')); ?>"  enctype="multipart/form-data" accept-charset="utf-8">
            <?php echo csrf_field(); ?>
            <div class="panel-body">
                <input type="hidden" name="type" value="sales">
                <div class="row">
                    <div class="col-7">
                        <label for="customer_id"><?php echo e(__('Customer')); ?>*</label>
                        <select name="customer_id" id="customer_id"
                                class="form-control custom-select auto-save select" required >
                            <option value=""><?php echo e(__('Select')); ?> <?php echo e(__('Customer')); ?></option>
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php if($errors->has('customer_id')): ?>
                            <div class="invalid-feedback">
                                <?php echo e($errors->first('customer_id')); ?>

                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="col-5">
                        <div class="form-group">
                            <label for="due_date"><?php echo e(__('due date')); ?>*</label>
                            <input type="date" class="form-control <?php echo e($errors->has('due_date') ? 'is-invalid' : ''); ?> "
                                id="due_date" name="due_date"  required style="line-height: 15px;">
                            <?php if($errors->has('due_date')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('due_date')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-9">
                        <table id="table" class="table ">
                            <thead>
                                <th><?php echo e(__('Item Name')); ?></th>
                                <th><?php echo e(__('Item Price')); ?></th>
                                <th><?php echo e(__('Quantity')); ?></th>
                                <th><?php echo e(__('Total')); ?></th>
                            </thead>
                            <tbody id='tbody'>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-2 flex-row">
                        <div class="flex flex-col">
                            <a class="btn btn-outline-secondary" id="addBtn"><?php echo e(__("Add Item")); ?></a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="discount"><?php echo e(__('Discount')); ?>*</label>
                            <input type="number" id="discount" onkeyup="discountPrice(this)" class="form-control <?php echo e($errors->has('discount') ? 'is-invalid' : ''); ?> "
                                    name="discount" value="0" required>
                            <?php if($errors->has('discount')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('discount')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="total"><?php echo e(__('Total')); ?>*</label>
                            <input type="number" id="total"  onkeyup="getRemaining()" class="form-control <?php echo e($errors->has('total') ? 'is-invalid' : ''); ?> "
                                    name="total" value="0" required >
                            <?php if($errors->has('total')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('total')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="barcode"><?php echo e(__('Paid')); ?>*</label>
                            <input type="number" onkeyup="getRemaining()" class="form-control <?php echo e($errors->has('paid') ? 'is-invalid' : ''); ?> "
                                id="paid" name="paid" min="0" value="0" required>
                            <?php if($errors->has('paid')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('paid')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="barcode"><?php echo e(__('Remaining')); ?>*</label>
                            <input type="number" class="form-control <?php echo e($errors->has('remaining') ? 'is-invalid' : ''); ?> "
                                id="remaining" name="remaining" value="0" required readonly>
                            <?php if($errors->has('remaining')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('remaining')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="address"><?php echo e(__('Note')); ?></label>
                            <textarea  class="form-control <?php echo e($errors->has('note') ? 'is-invalid' : ''); ?> "
                                    name="note" value="<?php echo e(old('note')); ?>" ><?php echo e(old('note')); ?></textarea>
                            <?php if($errors->has('note')): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors->first('note')); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-body text-center">
                <button class="btn btn-outline-success rounded-0 my-2 px-5" type="submit"><?php echo e(__('Save')); ?></button>
            </div>
        </form>

    </div>

    <?php $__env->startSection('scripts'); ?>
        <script src="<?php echo e(asset('front/js/select2.min.js')); ?>"></script>

        <script>
            $(document).ready(function() {
                var rowIdx = 0;
                $('#addBtn').on('click', function () {
                    $('#tbody').append(
                        `<tr>
                            <input class="form-control" type="hidden" name="item_count" value="${++rowIdx}">
                            <td><input class="form-control" type="text" name="item_name_${rowIdx}" value="" ></td>
                            <td><input class="form-control" type="number" onkeyup="itemTotal(this)" data-id="'+index+'" name="item_price_${rowIdx}" value="" >  </td>
                            <td><input class="form-control qty"  onkeyup="itemTotal(this)" type="number" data-id="" name="item_quantity_${rowIdx}" value="1" required>  </td>
                            <td><input class="form-control itemTotal" type="number" name="items['+index+'][total]" value="" readonly>  </td>
                            <td><button type="button" class="btn btn-link " onclick="removeAttr(this);"><?php echo e(__('Delete')); ?></button></td>
                        </tr>`
                    );
                });
                $('#tbody').on('click', '.remove', function () {
                    var child = $(this).closest('tr').nextAll();
                    child.each(function () {
                        var id = $(this).attr('id');
                        var idx = $(this).children('.row-index').children('p');
                        var dig = parseInt(id.substring(1));
                        idx.html(`Row ${dig - 1}`);
                        $(this).attr('id', `R${dig - 1}`);
                    });
                    $(this).closest('tr').remove();
                    rowIdx--;
                });

            });
            function removeAttr(el) {
                swal({
                    title: "<?php echo e(__('Are you sure')); ?>?",
                    text: "<?php echo e(__('You are deleting this item')); ?> ",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: '<?php echo e(__('Yes, I am sure!')); ?>',
                    cancelButtonText: "<?php echo e(__('No, cancel it')); ?>"
                }).then(
                    function (obj) {
                        $(el).parents('tr').remove();
                        let totalPrice = 0;
                        for(var i=0;i<$('.itemTotal').length;i++){
                            if(parseFloat($('.itemTotal')[i].value))
                                totalPrice += parseFloat($('.itemTotal')[i].value);
                        }
                        $('#total').attr('value',totalPrice);
                        $('#discount').val(0);
                        $('#remaining').val(0);
                        $('#paid').val(0);
                    }
                );
            }
            function discountPrice(discount) {
                discount  =  discount.value;
                let totalPrice = 0;
                for(var i=0;i<$('.itemTotal').length;i++){
                    if(parseInt($('.itemTotal')[i].value))
                        totalPrice += parseFloat($('.itemTotal')[i].value);
                }
                $('#total').attr('value',totalPrice-discount);
                $('#remaining').val(totalPrice-discount);
                $('#paid').val(0);
            }
            function itemTotal(qty) {
            let Qty = qty.value;
            let id = $(qty).attr('data-id');
            let price =  $('input[name="items['+id+'][price]"]').attr('value');
            let itemTotalPrice = price*Qty ;
            $('input[name="items['+id+'][total]"]').attr('value',itemTotalPrice);
                let totalPrice = 0;
                for(var i=0;i<$('.itemTotal').length;i++){
                    if(parseFloat($('.itemTotal')[i].value))
                        totalPrice += parseFloat($('.itemTotal')[i].value);
                }
                $('#total').val(totalPrice);
                $('#discount').val(0);
                $('#remaining').val(totalPrice);
                $('#paid').val(0);
            }

            function getRemaining() {
                paid  =  $('#paid').val();
                let total = $('#total').val();
                $('#remaining').val(total-paid);
            }
        </script>
    <?php $__env->stopSection(); ?>

 <?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> <?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/invoice/sales/create.blade.php ENDPATH**/ ?>