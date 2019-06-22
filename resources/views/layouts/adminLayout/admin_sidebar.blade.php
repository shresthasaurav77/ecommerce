<!-- <?php echo  $url = url()->current(); ?> -->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
     
    <li <?php if(preg_match("/dashboard/i",$url)){ ?>class="active" <?php }?>><a href="{{url('admin/dashboard')}}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Categories</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/categor/i",$url)){ ?> style="diplay:block;" <?php }?>>
        <li <?php if(preg_match("/add-category/i",$url)){ ?>class="active" <?php }?>><a href="{{url('/admin/add-category')}}">Add category</a></li>
        <li <?php if(preg_match("/view-categories/i",$url)){ ?>class="active" <?php }?> ><a href="{{url('/admin/view-category')}}">View Category</a></li>
      
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-info-sign"></i> <span>Products</span> </a>
      <ul>
        <li><a href="{{url('/admin/add-product')}}">Add Product</a></li>
        <li><a href="{{url('/admin/view-product')}}">View Product</a></li>
      
      </ul>
    </li>
      <li class="submenu"> <a href="#"><i class="icon icon-inbox"></i> <span>Coupons</span> </a>
      <ul>
        <li><a href="{{url('/admin/add-coupon')}}">Add Coupons</a></li>
        <li><a href="{{url('/admin/view-coupons')}}">View Coupons</a></li>
      
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Orders</span> <span class="label label-important">1</span></a>
      <ul <?php if(preg_match("/orders/i",$url)){ ?> style="diplay:block;" <?php }?>>
        
        <li <?php if(preg_match("/view-orders/i",$url)){ ?>class="active" <?php }?> ><a href="{{url('/admin/view-orders')}}">View Orders</a></li>
      
      </ul>
    </li>
     <li class="submenu"> <a href="#"><i class="icon icon-user"></i> <span>Users</span> <span class="label label-important">1</span></a>
      <ul <?php if(preg_match("/users/i",$url)){ ?> style="diplay:block;" <?php }?>>
        
        <li <?php if(preg_match("/view-users/i",$url)){ ?>class="active" <?php }?> ><a href="{{url('/admin/view-users')}}">View Users</a></li>
      
      </ul>
    </li>
        <li class="submenu"> <a href="#"><i class="icon icon-pencil"></i> <span>CMS Pages</span> <span class="label label-important">3</span></a>
      <ul <?php if(preg_match("/cms/i",$url)){ ?> style="diplay:block;" <?php }?>>
        <li <?php if(preg_match("/add-cms-page/i",$url)){ ?>class="active" <?php }?>><a href="{{url('/admin/add-cms-page')}}">Add CMS Pages</a></li>
        <li <?php if(preg_match("/view-cms-pages/i",$url)){ ?>class="active" <?php }?> ><a href="{{url('/admin/view-cms-pages')}}">View CMS pages</a></li>
      
      </ul>
    </li>
      <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Banners</span><span class="label label-important">4</span></a>
      <ul>
        <li><a href="{{url('/admin/add-banner')}}">Add Banners</a></li>
        <li><a href="{{url('/admin/view-banner')}}">View Banners</a></li>
      
      </ul>
    </li>
    <li class="submenu"> <a href="#"><i class="icon icon-file"></i> <span>Currencies</span><span class="label label-important">2</span></a>
      <ul <?php if(preg_match("/currencies/i",$url)){ ?> style="diplay:block;" <?php }?>>
        <li <?php if(preg_match("/add-currency/i",$url)){ ?>class="active" <?php }?>><a href="{{url('/admin/add-currency')}}">Add Currency</a></li>
        <li <?php if(preg_match("/view-currencies/i", $url)) { ?>class="active" <?php } ?>><a href="{{url('/admin/view-currencies')}}">View currency</a></li>
      
      </ul>
    </li>
  
    <li class="content"> <span>Monthly Bandwidth Transfer</span>
      <div class="progress progress-mini progress-danger active progress-striped">
        <div style="width: 77%;" class="bar"></div>
      </div>
      <span class="percent">77%</span>
      <div class="stat">21419.94 / 14000 MB</div>
    </li>
    <li class="content"> <span>Disk Space Usage</span>
      <div class="progress progress-mini active progress-striped">
        <div style="width: 87%;" class="bar"></div>
      </div>
      <span class="percent">87%</span>
      <div class="stat">604.44 / 4000 MB</div>
    </li>
  </ul>
</div>