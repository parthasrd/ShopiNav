<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php');
$page_name="list_bar";
$mgmtObj= new mgmt();
$list_bar = $mgmtObj->list_bar();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>List | <?php echo conf::SITE_TITLE; ?></title>
    <?php include('header-script.php'); ?>

</head>
<body class="topbar">
<?php include('left-bar.php'); ?>

<section id="wrapper">
    <?php include('header.php'); ?>

    <div class="container" style="margin-bottom: 20px;">
        <br>
        <div class="breadcrumb">
            <a href="dashboard.php" class="breadcrumb-item">Dashboard</a>
            <span class="breadcrumb-item">List</span>
        </div>

        <div class="container" style="margin-bottom: 20px;">

        <table id="tab_bars" class="display">
            <thead>
            <tr>
                <th>Sl No.</th>
                <th>Heading</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach($list_bar as $each_bar){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $each_bar->bars_title; ?></td>
                <td>
                    <?php  if($each_bar->bars_status=='Y'){  ?>
                        <label class="getit_change c_success" data-status="Y" data-id="<?php echo $each_bar->bars_id; ?>" >Active</label>
                    <?php } else { ?>
                        <label class="getit_change c_danger"  data-status="N" data-id="<?php echo $each_bar->bars_id; ?>">Disabled</label>
                    <?php } ?>
                </td>
                <td>
                    <a href="details-promotion.php?bid=<?php echo base64_encode($each_bar->bars_id); ?>" class="btn btn-blue">View</a>
                    <button type="button" value="dele"  data-id="<?php echo $each_bar->bars_id; ?>" class="del_promo btn btn-dark">Delete</button>
                </td>
            </tr>
            <?php $i++; } ?>
            </tbody>
        </table>

        </div>

        <a href="add-promotion.php" class="btn btn-blue">Add New</a>

    </div>


</section>
</body>
<script>
    $(document).ready( function () { $('#tab_bars').DataTable({searching: false, paging: false, info: false}); } );

    $(document).ready( function () {
        $('.del_promo').on('click', function(e) {
            var conf= confirm("Are you sure to delete this item?");
            if(conf)
            {
                var pid = $(this).data('id');
                e.preventDefault();
                var data = 'promo_id='+ pid;
                $.post("ajax/ajax_promotion.php", {
                    method: 'del_promotion',
                    data: data,
                },  function(data) {
                        location.reload();
                }, 'json');
            }
            else
            {
                return false;
            }
        });
    });

    // $(document).ready(function(){
    //     $('.getit_change').on('mouseover', function(e) {
    //        var data_id = $(this).data('id');
    //        var data_status = $(this).data('status');
    //        if(data_status=='Y'){
    //           $(this).text('Disable It');
    //           $(this).removeClass("btn-success");
    //           $(this).addClass("btn-primary");
    //        }
    //        if(data_status=='N'){
    //           $(this).text('Active It');
    //            $(this).removeClass("btn-danger");
    //            $(this).addClass("btn-primary");
    //        }
    //     });
    //
    //     $('.getit_change').on('mouseout', function(e) {
    //         var data_id = $(this).data('id');
    //         var data_status = $(this).data('status');
    //         if(data_status=='Y'){
    //             $(this).text('Active');
    //             $(this).addClass("btn-success");
    //         }
    //         if(data_status=='N'){
    //             $(this).text('Disabled');
    //             $(this).addClass("btn-danger");
    //         }
    //     });
    //
    // });

</script>

</html>