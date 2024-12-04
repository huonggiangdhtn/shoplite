<nav class="side-nav">
   
<ul>
        <li>
            <a href="<?php echo e(route('admin')); ?>" class="side-menu side-menu<?php echo e($active_menu=='dashboard'?'--active':''); ?>">
                <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li> 
       <!-- Blog -->
        <li>
          <a href="javascript:;.html" class="side-menu side-menu<?php echo e(($active_menu=='tag_list'|| $active_menu=='tag_add'||$active_menu=='blog_list'|| $active_menu=='blog_add'||$active_menu=='blogcat_list'|| $active_menu=='blogcat_add' )?'--active':''); ?>">
              <div class="side-menu__icon"> <i data-lucide="align-center"></i> </div>
              <div class="side-menu__title">
                  Bài viết
                  <div class="side-menu__sub-icon transform"> <i data-lucide="chevron-down"></i> </div>
              </div>
          </a>
          <ul class="<?php echo e(($active_menu=='tag_list'|| $active_menu=='tag_add'||$active_menu=='blog_list'|| $active_menu=='blog_add'||$active_menu=='blogcat_list'|| $active_menu=='blogcat_add')?'side-menu__sub-open':''); ?>">
              <li>
                  <a href="<?php echo e(route('blog.index')); ?>" class="side-menu <?php echo e($active_menu=='blog_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="compass"></i> </div>
                      <div class="side-menu__title">Danh sách bài viết </div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('blog.create')); ?>" class="side-menu <?php echo e($active_menu=='blog_add'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="plus"></i> </div>
                      <div class="side-menu__title"> Thêm bài viết</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('tag.index')); ?>" class="side-menu <?php echo e($active_menu=='tag_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="anchor"></i> </div>
                      <div class="side-menu__title">Tags </div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('blogcategory.index')); ?>" class="side-menu <?php echo e($active_menu=='blogcat_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="hash"></i> </div>
                      <div class="side-menu__title">Danh mục bài viết </div>
                  </a>
              </li>
        </ul>
    </li>
    <li>
            <a href="<?php echo e(route('comment.index')); ?>" class="side-menu <?php echo e($active_menu=='comment_list'||$active_menu=='comment_add'?'side-menu--active':''); ?>">
                <div class="side-menu__icon"> <i data-lucide="package"></i> </div>
                <div class="side-menu__title"> Bình luận</div>
            </a>
        
      </li> 
   
      <li>
        <?php
            $reg_totals = \DB::select("select count(id) as tong from orders where status = 'pending'");
            $reg_total = $reg_totals[0]->tong;
        ?>
          <a href="javascript:;" class="side-menu  class="side-menu <?php echo e(($active_menu=='or_list' || $active_menu=='customer_list'|| $active_menu=='wo_list'|| $active_menu=='wo_add'|| $active_menu=='delivery_list'    )?'side-menu--active':''); ?>">
              <div class="side-menu__icon"> <i data-lucide="shopping-cart"></i> </div>
              <div class="side-menu__title">
                  Quản lý bán hàng
                  <?php if($reg_total > 0): ?>
                            <div style="margin-top:-0.5rem"> &nbsp;
                                <span class="text-xs px-1 rounded-full bg-success text-white mr-1"><?php echo e($reg_total); ?></span>
                            </div>
                        <?php endif; ?>

                  <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
              </div>
          </a>
          <ul class="<?php echo e(($active_menu=='or_list'  )?'side-menu__sub-open':''); ?>">
               
             
              <li>
                  <a href="<?php echo e(route('order.index')); ?>" class="side-menu <?php echo e($active_menu=='or_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="shopping-cart"></i> </div>
                      <div class="side-menu__title"> Đơn đặt hàng
                        <?php if($reg_total > 0): ?>
                        <div style="margin-top:-0.5rem"> &nbsp;
                            <span class="text-xs px-1 rounded-full bg-success text-white mr-1"><?php echo e($reg_total); ?></span>
                        </div>
                        <?php endif; ?>

                      </div>
                  </a>
              </li>
             
             
          </ul>
      </li>
 
      <!-- product category menu -->
      <li>
          <a href="javascript:;" class="side-menu <?php echo e(($active_menu =='pro_add'|| $active_menu=='pro_list' || $active_menu =='brand_list' || $active_menu == 'brand_list' || $active_menu=='cat_add'|| $active_menu=='cat_list')?'side-menu--active':''); ?>">
              <div class="side-menu__icon"> <i data-lucide="box"></i> </div>
              <div class="side-menu__title">
                  Hàng hóa 
                  <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
              </div>
          </a>
            <ul class="<?php echo e(($active_menu =='pro_add'|| $active_menu=='pro_list' || $active_menu =='cat_add'|| $active_menu=='cat_list' || $active_menu =='brand_list' || $active_menu == 'brand_list')?'side-menu__sub-open':''); ?>">
              <li>
                  <a href="<?php echo e(route('product.index')); ?>" class="side-menu <?php echo e($active_menu=='pro_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                      <div class="side-menu__title">Danh sách hàng hóa</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('product.create')); ?>" class="side-menu <?php echo e($active_menu=='pro_add'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="plus"></i> </div>
                      <div class="side-menu__title"> Thêm hàng hóa</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('category.index')); ?>" class="side-menu <?php echo e($active_menu=='cat_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="archive"></i> </div>
                      <div class="side-menu__title"> Danh sách danh mục </div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('category.create')); ?>" class="side-menu <?php echo e($active_menu=='cat_add'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="plus"></i> </div>
                      <div class="side-menu__title"> Thêm danh mục </div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('brand.index')); ?>" class="side-menu <?php echo e($active_menu=='brand_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="package"></i> </div>
                      <div class="side-menu__title"> Ds nhà sản xuất </div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('brand.create')); ?>" class="side-menu <?php echo e($active_menu=='brand_add'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="plus"></i> </div>
                      <div class="side-menu__title"> Thêm nhà sản xuất </div>
                  </a>
              </li>
          </ul>
      </li>
      <!-- Nguoi dung menu  -->
      <li>
          <a href="javascript:;" class="side-menu  class="side-menu <?php echo e(($active_menu =='ugroup_add'|| $active_menu=='ugroup_list' || $active_menu =='ctm_add'|| $active_menu=='ctm_list'  )?'side-menu--active':''); ?>">
              <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
              <div class="side-menu__title">
                  Người dùng 
                  <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
              </div>
          </a>
          <ul class="<?php echo e(($active_menu =='ugroup_add'|| $active_menu=='ugroup_list' || $active_menu =='ctm_add'|| $active_menu=='ctm_list')?'side-menu__sub-open':''); ?>">
              <li>
                  <a href="<?php echo e(route('user.index')); ?>" class="side-menu <?php echo e($active_menu=='ctm_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                      <div class="side-menu__title">Danh sách người dùng</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('user.create')); ?>" class="side-menu <?php echo e($active_menu=='ctm_add'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="plus"></i> </div>
                      <div class="side-menu__title"> Thêm người dùng</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('ugroup.index')); ?>" class="side-menu <?php echo e($active_menu=='ugroup_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="circle"></i> </div>
                      <div class="side-menu__title">Ds nhóm người dùng</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('ugroup.create')); ?>" class="side-menu <?php echo e($active_menu=='ugroup_add'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="plus"></i> </div>
                      <div class="side-menu__title"> Thêm nhóm người dùng</div>
                  </a>
              </li>
          </ul>
      </li>
    
 
   
    <!-- setting menu -->
    <li>
        <a href="javascript:;.html" class="side-menu side-menu<?php echo e(($active_menu=='cmdfunction_list'||$active_menu=='cmdfunction_add'||$active_menu=='role_list'||$active_menu=='role_add'||$active_menu=='kiot'|| $active_menu=='setting_list'|| $active_menu=='log_list'||$active_menu=='banner_add'|| $active_menu=='banner_list')?'--active':''); ?>">
              <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
              <div class="side-menu__title">
                  Cài đặt
                  <div class="side-menu__sub-icon transform"> <i data-lucide="chevron-down"></i> </div>
              </div>
        </a>
        <ul class="<?php echo e(($active_menu=='cmdfunction_list'||$active_menu=='cmdfunction_add'||$active_menu=='role_list'||$active_menu=='role_add'||$active_menu=='kiot'|| $active_menu=='setting_list'|| $active_menu=='banner_add'|| $active_menu=='banner_list')?'side-menu__sub-open':''); ?>">
              <li>
                  <a href="<?php echo e(route('banner.index')); ?>" class="side-menu <?php echo e($active_menu=='banner_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="image"></i> </div>
                      <div class="side-menu__title">Danh sách banner </div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('banner.create')); ?>" class="side-menu <?php echo e($active_menu=='banner_add'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="plus"></i> </div>
                      <div class="side-menu__title"> Thêm banner</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('role.index',1)); ?>" class="side-menu <?php echo e($active_menu=='role_list'||$active_menu=='role_add'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="octagon"></i> </div>
                      <div class="side-menu__title"> Roles</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('cmdfunction.index',1)); ?>" class="side-menu <?php echo e($active_menu=='cmdfunction_list'||$active_menu=='cmdfunction_add'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="moon"></i> </div>
                      <div class="side-menu__title"> Chức năng</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('setting.edit',1)); ?>" class="side-menu <?php echo e($active_menu=='setting_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="key"></i> </div>
                      <div class="side-menu__title"> Thông tin công ty</div>
                  </a>
              </li>
              <li>
                  <a href="<?php echo e(route('log.index')); ?>" class="side-menu <?php echo e($active_menu=='log_list'?'side-menu--active':''); ?>">
                      <div class="side-menu__icon"> <i data-lucide="plus"></i> </div>
                      <div class="side-menu__title"> Nhật ký</div>
                  </a>
              </li>
              
          </ul>
    </li>
</ul>
</nav><?php /**PATH C:\xampp\htdocs\shoplite\resources\views/backend/layouts/sidebar.blade.php ENDPATH**/ ?>