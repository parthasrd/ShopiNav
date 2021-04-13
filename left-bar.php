<aside class="sidebar position-fixed top-0 left-0 overflow-auto h-100 float-left" id="show-side-navigation1">
    <div class="sidebar-header d-flex justify-content-center align-items-center px-3 py-4">
        <img
            class="img-fluid"
            width="100"
            src="images/logo.png"
            alt="">
    </div>
<!--    rounded-pill-->
    <ul class="categories list-unstyled">
        <li><i class="uil-estate fa-fw"></i><a href="dashboard.php" class="<?php if($page_name=='dashboard'){ echo "active"; } ?>"> Dashboard</a></li>
        <li><i class="uil-folder"></i><a href="add-promotion.php" class="<?php if($page_name=='add_bar'){ echo "active"; } ?>"> Add New</a></li>
        <li><i class="uil-calendar-alt"></i><a href="list-promotion.php" class="<?php if($page_name=='list_bar'){ echo "active"; } ?>"> Lists</a></li>
        <li><i class="uil-envelope-download fa-fw"></i><a href="#" class="<?php if($page_name=='setting'){ echo "active"; } ?>"> Setting</a></li>
    </ul>
</aside>