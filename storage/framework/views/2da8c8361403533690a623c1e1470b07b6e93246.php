<div class="h-full p-6 sm:px-20 bg-white border-b border-gray-200">
    <div>
         <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.application-logo','data' => ['class' => 'block h-12 w-auto']]); ?>
<?php $component->withName('jet-application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'block h-12 w-auto']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?> 
    </div>

    
</div>


<?php /**PATH /media/a7m6d/Disk_Data/project/laravel_PJ/Aisent/carton_sys2/resources/views/vendor/jetstream/components/welcome.blade.php ENDPATH**/ ?>