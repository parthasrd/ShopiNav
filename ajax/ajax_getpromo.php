<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");

require_once($_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php');
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


    $bar_details = $mgmtObj->show_promo();

    $bars_id = $bar_details->bars_id;
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

?>
<?php if($bars_id){ ?>
<style>
    .dynamic_v{
        color: <?php echo $text_color; ?>;
        background: <?php echo $bg_color; ?>;
    }
    .dynamic_cbg{ font-size: <?php echo $fontsize_arr[$heading_style]; ?> }
    .dyncbttn{ <?php echo $bttn_cust_css; ?> }

    .barstyl{ padding: 10px; text-align: center;}
    .genbttn { padding: 10px;}

    .cb_txt { display: inline-block; float: none; vertical-align: middle; padding-right: 1.25em; }
    .cb_btn { display: inline-block; float: none; vertical-align: middle; }
    .cb_txt h1{ font-size: 32px; }
    .cb_txt h2{ font-size: 24px; }
    .cb_txt h3{ font-size: 18.72px; }
    .cb_txt h4{ font-size: 16px; }
    .cb_txt h5{ font-size: 13.28px; }
    .cb_txt h6{ font-size: 10.72px; }

</style>

<div class="barstyl dynamic_v">
    <div class="cb_txt dynamic_cbg"><?php echo $banner_text; ?></div>
    <?php if($is_button){ ?>
        <div class="cb_btn">
            <button type="button" id="redic_id" class="genbttn dyncbttn"><?php echo $bttn_text; ?></button>
        </div>
    <?php } ?>
</div>

<script>
    $(document).ready(function(){
        $('#redic_id').on('click', function(e) {
            var redicurl = '<?php echo $bttn_link; ?>';
            var is_another_tab = '<?php echo $is_another_tab; ?>';
            if(is_another_tab==1){ window.open(redicurl, '_blank').focus(); }
            else{ window.location=redicurl; }
        });
    });
</script>
<?php } else { echo "NO_PROMO"; } ?>