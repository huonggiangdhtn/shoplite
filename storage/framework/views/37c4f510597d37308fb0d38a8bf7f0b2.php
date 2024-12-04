<?php
 
  $setting =\App\Models\SettingDetail::find(1);
  $user = auth()->user();
  if($user)
  {
      $sql  = "select c.quantity, d.* from (SELECT * from shoping_carts where user_id = "
      .$user->id.") as c left join products as d on c.product_id = d.id where d.status = 'active'  ";
      $pro_carts =   \DB::select($sql ) ;
  }
  else
  {
      $pro_carts = [];
  }
  $cart_size= count($pro_carts);
?>

<?php $__env->startSection('head_css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->make('frontend_tp.layouts.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  
<div class="wrapper !bg-[#ffffff]">
    <div class="container pt-14 xl:pt-[4.5rem] lg:pt-[4.5rem] md:pt-[4.5rem] pb-[4.5rem] xl:pb-24 lg:pb-24 md:pb-24">
        <div class="xl:w-10/12 w-full flex-[0_0_auto] px-[15px] max-w-full !mx-auto">
            <div class ='job-list'>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $photos = explode(",",$product->photo);
                    ?>
                       <div class="card-body p-5">
                            <div  class="card mb-4 lift" >
                            <span class="flex flex-wrap mx-[-15px] justify-between items-center">
                                <span class="xl:w-3/12 lg:w-3/12 md:w-4/12 w-full w-3/12  flex-[0_0_auto] px-[15px] max-w-full mb-2 xl:mb-0 lg:mb-0 md:mb-0 flex items-center text-[#60697b]">
                                  
                                 <img src="<?php echo e($photos[0]); ?>" class="avatar !w-[5rem]" />
                                    
                                </span>
                                <span class="xl:w-6/12 lg:w-6/12 md:w-5/12 w-6/12   flex-[0_0_auto] px-[15px] max-w-full text-[#60697b] flex items-center">
                                    <a  href="<?php echo e(route('front.product.view',$product->slug)); ?>"  >
                                    <?php echo e($product->title); ?>

                                    </a>
                                </span>
                                <span class="xl:w-3/12 lg:w-3/12 md:w-3/12 w-3/12   flex-[0_0_auto] px-[15px] max-w-full text-[#60697b] flex items-center">
                                        <a href="<?php echo e(route('front.wishlist.remove',$product->id)); ?> " >
                                                     Xóa   
                                        </a>
                                </span>
                            </div>
                        </div>
                    
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
function show(id)
{
    $("#order" + id).toggle();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend_tp.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shoplite\resources\views/frontend_tp/profile/wishlist.blade.php ENDPATH**/ ?>