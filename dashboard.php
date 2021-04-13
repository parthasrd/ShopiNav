<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php');
$page_name="dashboard";
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo conf::SITE_TITLE; ?></title>
    <?php include('header-script.php'); ?>
    
</head>
<body class="topbar">
<?php include('left-bar.php'); ?>

    <section id="wrapper">
        <?php include('header.php'); ?>

        <div class="container" style="margin-bottom: 20px;">
            <br>
            <div class="breadcrumb">
                <span class="breadcrumb-item">Dashboard</span>
            </div>


        </div>

    </section>
</body>
</html>