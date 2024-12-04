
<?php $__env->startSection('content'); ?>

<div class="content">
<?php echo $__env->make('backend.layouts.notification', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <h2 class="intro-y text-lg font-medium mt-10">
        Danh sách trả bảo hành từ nhà cung cấp
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="<?php echo e(route('maintainback.create')); ?>" class="btn btn-primary shadow-md mr-2">Thêm trả bảo hành</a>
            
            <div class="hidden md:block mx-auto text-slate-500">Hiển thị trang <?php echo e($maintainbacks->currentPage()); ?> trong <?php echo e($maintainbacks->lastPage()); ?> trang</div>
            
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">ĐỐI TÁC</th>
                        <th class="text-center whitespace-nowrap">CHI PHÍ</th>
                        <th class="text-center whitespace-nowrap">ĐÃ THANH TOÁN</th>
                        <th class="text-center whitespace-nowrap">NGƯỜI LẬP</th>
                       
                        <th class="text-center whitespace-nowrap">NGÀY LẬP</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $maintainbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        if($item->final_amount != 0)
                            $temp = (int)(($item->paid_amount/$item->final_amount)*100);
                        else
                            $temp = 0;
                        if($temp==0)
                            $temp = 1;
                        $class_p = "";
                        if($temp < 50)
                        {
                            $class_p = "bg-danger";
                        }
                        else
                        {
                            if($temp < 100)
                            {
                                $class_p ="bg-warning";
                            }
                        }
                    ?>
                    <tr class="intro-x ">
                        <td>
                            <a  class="tooltip "  title="Xem công nợ"  href="<?php echo e(route('user.showsup',$item->supplier_id)); ?>">       
                                        <?php echo e(\App\Models\User::where('id',$item->supplier_id)->value('full_name')); ?>

                            </a>
                        </td>
                        <td>
                        <?php echo e(number_format($item->final_amount, 0, '.', ',')); ?>

                        </td>
                        <td class="text-right">
                           
                           <div class="progress h-6 mt-3">
                               <div class="progress-bar <?php echo e($class_p); ?> " role="progressbar" style="  width:<?php echo e($temp); ?>%"
                                aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                <?php echo e(number_format($item->paid_amount, 0, '.', ',')); ?> 
                               </div>
                           </div>
                       </td>
                        <td>
                            <?php echo e(\App\Models\User::where('id',$item->vendor_id)->value('full_name')); ?>

                        </td>
                        
                        <td>
                            <?php echo e($item->created_at); ?>

                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                            <div class="dropdown py-3 px-1 ">  
                                <a class="btn btn-primary" aria-expanded="false" data-tw-toggle="dropdown"> 
                                    hoạt động
                                </a>
                                <div class="dropdown-menu w-40"> 
                                    <ul class="dropdown-content">
                                        
                                        <?php if($item->paid_amount < $item->final_amount): ?>
                                            <li> <a href=" <?php echo e(route('maintainback.paid',$item->id)); ?>" class="dropdown-item flex items-center mr-3" href="javascript:;"> <i data-lucide="dollar-sign" class="w-4 h-4 mr-1"></i> Trả tiền </a></li> 
                                        <?php endif; ?>    
                                        <li><a href="<?php echo e(route('maintainback.show',$item->id)); ?>" class="dropdown-item flex items-center mr-3" href="javascript:;"> <i data-lucide="eye" class="w-4 h-4 mr-1"></i> Xem </a></li>
                                        <li><a href="<?php echo e(route('maintainback.edit',$item->id)); ?>" class="dropdown-item flex items-center mr-3" href="javascript:;"> <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> Edit </a></li>
                                         
                                        <li> 
                                            <form action="<?php echo e(route('maintainback.destroy',$item->id)); ?>" method = "post">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('delete'); ?>
                                            <a class="dropdown-item flex items-center text-danger dltBtn" data-id="<?php echo e($item->id); ?>" href="javascript:;" data-tw-toggle="modal" data-tw-target="#delete-confirmation-modal"> <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                            </form>
                                        </li>
                                         
                                </div> 
                            </div> 
                            </div>
                        </td>
                    </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </tbody>
            </table>
            
        </div>
    </div>
    <!-- END: HTML Table Data -->
        <!-- BEGIN: Pagination -->
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
            <nav class="w-full sm:w-auto sm:mr-auto">
                <?php echo e($maintainbacks->links('vendor.pagination.tailwind')); ?>

            </nav>
           
        </div>
        <!-- END: Pagination -->
</div>
  
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo e(asset('backend/assets/vendor/js/bootstrap-switch-button.min.js')); ?>"></script>
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    $('.dltBtn').click(function(e)
    {
        var form=$(this).closest('form');
        var dataID = $(this).data('id');
        e.preventDefault();
        Swal.fire({
            title: 'Bạn có chắc muốn xóa không?',
            text: "Bạn không thể lấy lại dữ liệu sau khi xóa",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vâng, tôi muốn xóa!'
            }).then((result) => {
            if (result.isConfirmed) {
                // alert(form);
                form.submit();
                // Swal.fire(
                // 'Deleted!',
                // 'Your file has been deleted.',
                // 'success'
                // );
            }
        });
    });

    
</script>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\shop\resources\views/backend/maintainbacks/index.blade.php ENDPATH**/ ?>