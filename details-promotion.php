<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php');
$page_name="list_bar";
$mgmtObj= new mgmt();

$fontsize_arr = array(
    "H1"=> "32px",
    "H2"=> "24px",
    "H3"=> "18.72px",
    "H4"=> "16px",
    "H5"=> "13.28px",
    "H6"=> "10.72px"
);
$hdng_arr = array("H1","H2","H3","H4","H5","H6");

if(trim($_REQUEST['bid'])!='')
{
    $bid = base64_decode(trim($_REQUEST['bid']));
    $bar_details = $mgmtObj->bar_details($bid);

    $bars_title = stripslashes($bar_details->bars_title);
    $bars_values = json_decode($bar_details->bars_values);

    $heading_style = $bars_values->fnt_styl;
    $banner_text = stripslashes($bars_values->banner_text);
    $text_color = $bars_values->text_color;
    $bg_color = $bars_values->bg_color;

    $is_button = $bars_values->is_button;
    $bttn_text = $bars_values->bttn_text;
    $bttn_link = $bars_values->bttn_link;

    $bttn_cust_css = stripslashes($bars_values->bttn_cust_css);


    $is_another_tab = $bars_values->is_another_tab;
    $bars_status = $bar_details->bars_status;
}
else{
    echo "<script>window.location.href='list-bar.php'</script>";
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Topbar Management</title>
    <?php include('header-script.php'); ?>
<style>
    .dynamic_v{
        color: <?php echo $text_color; ?>;
        background: <?php echo $bg_color; ?>;
    }
    .dynamic_cbg{ font-size: <?php echo $fontsize_arr[$heading_style]; ?> }
    .dyncbttn{ <?php echo $bttn_cust_css; ?> }
</style>
</head>
<body class="topbar">
<?php include('left-bar.php'); ?>

<section id="wrapper">
    <?php include('header.php'); ?>

    <div class="container" style="margin-bottom: 20px;">
        <br>
        <div class="breadcrumb">
            <a href="dashboard.php" class="breadcrumb-item">Dashboard</a>
            <a href="list-promotion.php" class="breadcrumb-item">List</a>
            <span class="breadcrumb-item"><?php echo $bars_title; ?></span>
        </div>



        <div class="barstyl dynamic_v">
            <div class="cb_txt dynamic_cbg"><?php echo $banner_text; ?></div>
            <?php if($is_button){ ?>
            <div class="cb_btn">
                <button type="button" id="redic_id" class="genbttn dyncbttn"><?php echo $bttn_text; ?></button>
            </div>
            <?php } ?>
        </div>
        <hr>
        <div style="margin: 10px 0; text-align: right">
            <a href="edit-promotion.php?bid=<?php echo base64_encode($bar_details->bars_id); ?>" type="button" class="btn_wdth_100 btn btn-secondary">Edit</a>
            <?php if($bars_status=='N'){ ?>
            <button type="button" id="publishme" data-id="<?php echo $bid; ?>" class="btn_wdth_100 btn btn-dark">Publish</button>
            <?php } else { ?>
            <button type="button" id="deactivateme" data-id="<?php echo $bid; ?>" class="btn_wdth_100 btn btn-dark">InActivate</button>
            <?php } ?>
        </div>



    </div>

</section>
</body>
<script>
    $(document).ready(function(){
        $('#redic_id').on('click', function(e) {
           var redicurl = '<?php echo $bttn_link; ?>';
           var is_another_tab = '<?php echo $is_another_tab; ?>';
           if(is_another_tab==1){ window.open(redicurl, '_blank').focus(); }
           else{ window.location=redicurl; }
        });

        $('#publishme').on('click', function(e) {
            var conf= confirm("All other promotional bars will deactivate!! Proceed ?");
            if(conf)
            {
                var pid = $(this).data('id');
                e.preventDefault();
                var data = 'promo_id='+ pid;
                $.post("ajax/ajax_promotion.php", {
                    method: 'publish_promotion',
                    data: data,
                },  function(data) {
                    location.reload();
                }, 'json');
            }
            else { return false; }
        });

        $('#deactivateme').on('click', function(e) {
            var conf= confirm("Are you sure to in-active?");
            if(conf)
            {
                var pid = $(this).data('id');
                e.preventDefault();
                var data = 'promo_id='+ pid;
                $.post("ajax/ajax_promotion.php", {
                    method: 'deactivate_promotion',
                    data: data,
                },  function(data) {
                    location.reload();
                }, 'json');
            }
            else { return false; }
        });

    });
</script>
</html>