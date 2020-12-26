<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name')); ?> | <?php echo $__env->yieldContent('title'); ?></title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <?php echo \Livewire\Livewire::styles(); ?>

        <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">

        <link rel="stylesheet" href="<?php echo e(asset('front/css/bootstrap.css')); ?>">
        <link href="<?php echo e(asset('front/plugins/font-awesome/css/font-awesome.min.css')); ?>" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.23/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/fc-3.3.2/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.1/datatables.min.css"/>

        

        
        
        


        
        <!-- Scripts -->
        <script src="<?php echo e(mix('js/app.js')); ?>" defer></script>
    </head>
    <body class="font-sans antialiased">

        <div class="flex flex-col h-screen justify-between bg-gray-100">
            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('navigation-dropdown')->html();
} elseif ($_instance->childHasBeenRendered('zANMix3')) {
    $componentId = $_instance->getRenderedChildComponentId('zANMix3');
    $componentTag = $_instance->getRenderedChildComponentTagName('zANMix3');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('zANMix3');
} else {
    $response = \Livewire\Livewire::mount('navigation-dropdown');
    $html = $response->html();
    $_instance->logRenderedChild('zANMix3', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>

            <!-- Page Heading -->
            <header class="h-full border-b bg-white shadow">
                <div class="flex justify-between max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    
                    <?php echo $__env->yieldContent('header'); ?>
                </div>
            </header>

            <!-- Page Content -->
            <main class="md:auto">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white overflow-hidden shadow-2xl sm:rounded-lg">
                            <?php echo e($slot); ?>

                        </div>
                    </div>
                </div>
            </main>

            




            <footer class="h-full bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <p class="text-center font-semibold text-sm text-gray-600">Develop By <a class="text-sm text-indigo-700" href="http://www.aisent.net/" target="_blank">Aisent</a> 2021 All Right Reserved &#0169;</p>
                </div>
            </footer>
        </div>

        <?php echo \Livewire\Livewire::scripts(); ?>

        <!--JAVASCRIPT-->
        <!--=================================================-->
        <!--jQuery [ REQUIRED ]-->
        <script src="<?php echo e(asset('front/js/jquery-2.1.1.min.js')); ?>"></script>
        <script src="<?php echo e(asset('front/js/bootstrap.min.js')); ?>"></script>
        <script src="<?php echo e(asset('front/js/scripts.js')); ?>"></script>
        <script src="<?php echo e(asset('front/plugins/moment/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset('front/plugins/moment-range/moment-range.js')); ?>"></script>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/jszip-2.5.0/dt-1.10.23/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/fc-3.3.2/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.1/sp-1.2.2/sl-1.3.1/datatables.min.js"></script>

        

        
        

        

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        
        <?php echo $__env->yieldContent('scripts'); ?>
        <script>
            function received(url,el) {
                swal({
                    title: "<?php echo e(__('Are you sure')); ?>?",
                    text: "<?php echo e(__('انه تم دفع قيمه هده الفاتوره')); ?> ",
                    // icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: '<?php echo e(__('Yes, I am sure!')); ?>',
                    cancelButtonText: "<?php echo e(__('No, cancel it')); ?>"
                }).then(
                    function (obj) {
                        // if (obj.value) {
                        window.location = url;
                    }
                );
            }
            function editDate(date,href,event) {
                let modal = $('#editDateModal');
                modal.find('.modal-body input[name="date"]').val(date);

                modal.find('.modal-body form').attr("action", href);

            };
        </script>
    </body>
</html>
<?php /**PATH C:\Websites\bussiness31\carton_v2\resources\views/layouts/app.blade.php ENDPATH**/ ?>