<?php
 
  $setting =\App\Models\SettingDetail::find(1);
  $detail = $setting;
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
  $front_view = env('FRONT_THEME');
?>


<?php $__env->startSection('content'); ?>
<style>
    .styled-button {
    background-color: #4CAF50; /* Green background */
    border: none; /* Remove border */
    color: white; /* White text */
    padding: 15px 32px; /* Some padding */
    text-align: center; /* Center the text */
    text-decoration: none; /* Remove underline */
    display: inline-block; /* Make it an inline-block element */
    font-size: 16px; /* Increase font size */
    margin: 4px 2px; /* Some margin */
    cursor: pointer; /* Add a pointer cursor on hover */
    border-radius: 12px; /* Rounded corners */
    transition: background-color 0.3s, transform 0.3s; /* Smooth transitions */
}

/* Change background color and add shadow on hover */
.styled-button:hover {
    background-color: #45a049; /* Darker green */
    transform: scale(1.05); /* Slightly enlarge the button */
}

/* Change background color when active (clicked) */
.styled-button:active {
    background-color: #3e8e41; /* Even darker green */
    transform: scale(0.95); /* Slightly shrink the button */
}

/* Add some focus styling */
.styled-button:focus {
    outline: none; /* Remove default outline */
    box-shadow: 0 0 0 3px rgba(66, 133, 244, 0.6); /* Add custom outline */
}

</style>
<div class="container " style="min-height:400px">
    <div class="row justify-content-center">
        <div  style="margin-top:30px">
            <div  >
                <center>
                    <h3 style="padding: 20px;" >Thiết lập lại mật khẩu</h3>
                    <p> Để thiết lập lại mật khẩu, bạn cần nhập email của tài khoản để hệ thống sẽ gửi đến địa chỉ email nội dung hướng dẫn thiết lập lại mật khẩu. </p>
                    <div class="card-body">
                        <?php if(session('status')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo e(session('status')); ?>

                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('password.email')); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end"><?php echo e(__('Email Address')); ?></label>

                                <div class="col-md-6">
                                    <input style="border: 1px solid; padding:10px; width:80%" id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="styled-button  ">
                                        Lấy lại mật khẩu  
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </center>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($front_view.'.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\shoplite\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>