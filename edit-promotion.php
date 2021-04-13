<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php');
$page_name="list_bar";
$mgmtObj= new mgmt();

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
    $status = $bars_values->status;
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

    <script>
        $(document).ready( function() {

            $('.demo').each( function() {
                $(this).minicolors({
                    control: $(this).attr('data-control') || 'hue',
                    defaultValue: $(this).attr('data-defaultValue') || '',
                    format: $(this).attr('data-format') || 'hex',
                    keywords: $(this).attr('data-keywords') || '',
                    inline: $(this).attr('data-inline') === 'true',
                    letterCase: $(this).attr('data-letterCase') || 'lowercase',
                    opacity: $(this).attr('data-opacity'),
                    position: $(this).attr('data-position') || 'bottom',
                    swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
                    change: function(hex, opacity) {
                        var log;
                        try {
                            log = hex ? hex : 'transparent';
                            if( opacity ) log += ', ' + opacity;
                            console.log(log);
                        } catch(e) {}
                    },
                    theme: 'default'
                });

            });

        });
    </script>

</head>
<body class="topbar">
<?php include('left-bar.php'); ?>

<section id="wrapper">
    <?php include('header.php'); ?>

    <div class="container" style="margin-bottom: 20px;">
        <form id="bar_bnnr">
            <br>
            <div class="breadcrumb">
                <a href="dashboard.php" class="breadcrumb-item">Dashboard</a>
                <a href="list-promotion.php" class="breadcrumb-item">List</a>
                <span class="breadcrumb-item"><?php echo $bars_title; ?></span>
            </div>
            <div class="row seprat">
                <input type="hidden" name="bars_id" value="<?php echo $bid; ?>">
                <div class="col-md-2">
                    <label class="">Heading Size</label>
                    <select class="form-control" name="fnt_styl">
                        <?php foreach($hdng_arr as $each_heading){ ?>
                        <option value="<?php echo $each_heading; ?>"<?php if($each_heading==$heading_style){ ?>selected<?php } ?>><?php echo $each_heading; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="">Banner Text</label>
                    <input type="text" name="banner_text" value="<?php echo $bars_title; ?>" class="form-control">

                    <div class="row" style="padding-top: 10px;">
                        <div class="col-md-5">
                            <label for="text-field">Text Color</label>
                            <input type="text" name="text_color" id="text_color" class="demo form-control" value="<?php echo $text_color; ?>" style="height: 28px;">
                        </div>
                        <div class="col-md-5">
                            <label for="text-field">Background Color</label>
                            <input type="text" name="bg_color" id="bg_color" class="demo form-control" value="<?php echo $bg_color; ?>" style="height: 28px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <input id="is_add_bttn" type="checkbox" name="is_button" value="1"<?php if($is_button){ echo "checked"; } ?> >
                    <label for="is_add_bttn" class="">Add Button</label> (Button Caption Here)
                    <input type="text" name="bttn_text" value="<?php echo stripslashes($bttn_text); ?>" class="form-control">
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <label class="">Button Link</label>
                    <input type="text" name="bttn_link" value="<?php echo stripslashes($bttn_link); ?>" class="form-control">
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <label class="">Add Custom CSS For Button</label>
                    <textarea name="bttn_cust_css" class="form-control" rows="5"><?php echo stripslashes($bttn_cust_css); ?></textarea>
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <input id="is_another_tab" type="checkbox" name="is_another_tab" value="1"<?php if($is_another_tab){ echo " checked"; } ?> >
                    <label for="is_another_tab" class="">Open in another tab</label>
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <button type="button" id="save_bar_bttn" class="btn btn-blue">Save</button>

                    <button type="button" id="sp_bar_bttn" class="btn btn-blue">Save & Publish</button>
                </div>
            </div>

            <div id="success-alert">
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>Success! </strong> Product have added to your wishlist.
                </div>
                <br><br>
            </div>

        </form>

    </div>


</section>
</body>

<script type="text/javascript">
    $(document).ready(function(){ $("#success-alert").hide();
        $('#save_bar_bttn').on('click', function(e) {

            e.preventDefault();
            $.post("ajax/ajax_promotion.php", {
                method: 'edit_topbar',
                data: $( '#bar_bnnr' ).serialize()
            },  function(data) {
                // console.log(data);
                //
                // $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                //     $("#success-alert").slideUp(500);
                // });

                window.location.href='list-promotion.php';

            }, 'json');
        });
    });
</script>
</html>