<?php
$page_name="add_bar";
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
                <span class="breadcrumb-item">Add New</span>
            </div>
            <div class="row seprat">
                <div class="col-md-2">
                    <label class="">Heading Size</label>
                    <select class="form-control" name="fnt_styl">
                        <option value="H1">H1</option>
                        <option value="H2">H2</option>
                        <option value="H3">H3</option>
                        <option value="H4">H4</option>
                        <option value="H5">H5</option>
                        <option value="H6">H6</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <label class="">Banner Text</label>
                    <input type="text" name="banner_text" class="form-control">

                    <div class="row" style="padding-top: 10px;">
                        <div class="col-md-5">
                            <label for="text-field">Text Color</label>
                            <input type="text" name="text_color" id="text_color" class="demo form-control" value="#70c24a" style="height: 28px;">
                        </div>
                        <div class="col-md-5">
                            <label for="text-field">Background Color</label>
                            <input type="text" name="bg_color" id="bg_color" class="demo form-control" value="#FFF000" style="height: 28px;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <input id="is_add_bttn" type="checkbox" name="is_button" value="1">
                    <label for="is_add_bttn" class="">Add Button</label> (Button Caption Here)
                    <input type="text" name="bttn_text" class="form-control">
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <label class="">Button Link</label>
                    <input type="text" name="bttn_link" class="form-control">
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <label class="">Add Custom CSS For Button</label>
                    <textarea name="bttn_cust_css" class="form-control" rows="5"></textarea>
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <input id="is_another_tab" type="checkbox" name="is_another_tab" value="1">
                    <label for="is_another_tab" class="">Open in another tab</label>
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <label class="">Status&nbsp;</label>
                    <input id="status_y" type="radio" value="Y" name="status" > <label for="status_y">Active</label>
                    <input id="status_n" type="radio" value="N" name="status" checked> <label for="status_n">In-active</label>
                </div>
            </div>

            <div class="row seprat">
                <div class="col-md-10">
                    <button type="button" id="add_bar_bttn" class="btn btn-blue">SAVE</button>
                </div>
            </div>

            </form>

        </div>


    </section>
</body>

<script type="text/javascript">
$(document).ready(function(){
    $('#add_bar_bttn').on('click', function(e) {
        e.preventDefault();
        $.post("ajax/ajax_promotion.php", {
            method: 'create_new_topbar',
            data: $( '#bar_bnnr' ).serialize()
        },  function(data) {
                console.log(data);
        }, 'json');
    });
});
</script>
</html>