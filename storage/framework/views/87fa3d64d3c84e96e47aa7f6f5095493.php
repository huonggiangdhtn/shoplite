
<?php $__env->startSection('content'); ?>

<div class="content">
<?php echo $__env->make('backend.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 2xl:col-span-9">
                        <div class="grid grid-cols-12 gap-6 mt-8">
                            <!-- BEGIN: General Report -->
                            <div class="col-span-12 ">
                                <div class="intro-y flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                         Báo cáo chung
                                    </h2>
                                </div>
                                <div class="grid grid-cols-12 gap-6 mt-5">
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <a   title="Xem chi tiết">
                                                <div class="box p-5">
                                                    <div class="flex">
                                                        <i data-lucide="shopping-cart" class="report-box__icon text-primary"></i> 
                                                        <div class="ml-auto">
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="text-3xl font-medium leading-8 mt-6"><?php echo e(Number_format($sobai,0,'.',',')); ?></div>
                                                    <div class="text-base text-slate-500 mt-1">Số bài viết</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <a   title="Xem chi tiết">
                                                <div class="box p-5">
                                                    <div class="flex">
                                                        <i data-lucide="credit-card" class="report-box__icon text-pending"></i> 
                                                        <div class="ml-auto">
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="text-3xl font-medium leading-8 mt-6"> <?php echo e(Number_format($sodon,0,'.',',')); ?></div>
                                                    <div class="text-base text-slate-500 mt-1"> Số đơn hàng</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                                        <div class="report-box zoom-in">
                                            <a   title="Xem chi tiết">
                                                <div class="box p-5">
                                                    <div class="flex">
                                                        <i data-lucide="credit-card" class="report-box__icon text-pending"></i> 
                                                        <div class="ml-auto">
                                                        
                                                        </div>
                                                    </div>
                                                    <div class="text-3xl font-medium leading-8 mt-6"> <?php echo e(Number_format($tongdon,0,'.',',')); ?></div>
                                                    <div class="text-base text-slate-500 mt-1"> Tổng đơn hàng</div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END: General Report -->
                            <!-- BEGIN: Sales Report -->
                             
                            <!-- ds sản phẩm bán chạy trong 2 tháng -->
                            <div class="col-span-12 lg:col-span-12">
                                <h2 style="padding-top:10px;padding-bottom:10px" class="text-success text-lg font-medium truncate mr-5"> 
                                    Danh sách sản phẩm bán chạy trong hai tháng gần đây
                                </h2>
                                <table class="table">
                                    <thead class="table-dark">
                                        <tr> <td> Tên </td>  </tr>
                                    </thead>
                                    <?php $__currentLoopData = $hotproducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td> 
                                            <a href="<?php echo e(route('product.show',$pro->id)); ?>">
                                                <?php echo e($pro->title); ?>

                                            </a> 
                                        </td>
                                        
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </table>

                            </div>
                            <!-- end ds sản phẩm bán chạy trong 2 tháng -->
                            <!-- ds sản phẩm bán chạy cần nhập -->
                            
                        </div>
                    </div>
                    <!-- hoạt động gần đây -->
                    <div class="col-span-12 2xl:col-span-3">
                                <div class="intro-y block sm:flex items-center h-10">
                                    <h2 class="text-lg font-medium truncate mr-5">
                                        Hoạt động gần đây
                                    </h2>
                                    <!-- <div class="sm:ml-auto mt-3 sm:mt-0 relative text-slate-500">
                                        <i data-lucide="calendar" class="w-4 h-4 z-10 absolute my-auto inset-y-0 ml-3 left-0"></i> 
                                        <input type="text" class="datepicker form-control sm:w-56 box pl-10">
                                    </div> -->
                                </div>
                                <div class="mt-5 relative before:block before:absolute before:w-px before:h-[85%] before:bg-slate-200 before:dark:bg-darkmode-400 before:ml-5 before:mt-5">
                                     <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    
                                     <?php
                                                    $url = "";
                                                    $total = 0;
                                                    $classname="text-danger";
                                                    // echo strcmp($log->doc_type,  "wi");
                                                    
                                                    // echo $invoice;
                                            ?>
                                        <div class="intro-x relative flex items-center mb-3"  >
                                            <div class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                                                <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                                </div>
                                            </div>
                                            <a style="width:100%" href="<?php echo e($url); ?>">
                                                <div class="box px-5 py-3 ml-4 flex-1 zoom-in" >
                                                    <div class="flex items-center">
                                                        <div class="font-medium"><?php echo e(\App\Models\User::find($log->user_id)->full_name); ?></div>
                                                        <div class="text-xs text-slate-500 ml-auto"><?php echo e($log->created_at); ?></div>
                                                    </div>
                                                    <div class="text-slate-500 mt-1 <?php echo e($classname); ?>">
                                                        <?php echo e($log->content); ?>

                                                
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                    </div>
                     <!-- end hoạt động gần đây -->
                </div>
</div>
<link href="https://cdn.anychart.com/releases/v8/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
<link href="https://cdn.anychart.com/releases/v8/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

 

  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shoplite\resources\views/backend/index.blade.php ENDPATH**/ ?>