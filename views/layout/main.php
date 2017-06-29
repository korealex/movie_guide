<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?? "Movie Guide";?></title>
    <link rel="stylesheet" href="/assets/css/bulma.css">
    <link rel="stylesheet" href="/assets/css/cosmo-bulmaswatch.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    <?php if(isset($styles)){
        echo $styles;
    }?>

</head>

<body>
<?php if(isset($nav)){
    echo $nav;
}?>

<?php if(isset($content)){
    echo $content;
}?>

<?php if(isset($footer)){
    echo $footer;
}?>

<script src="/assets/js/jquery-3.2.1.js"></script>
<script src="/assets/js/index.js"></script>
<script src="/assets/js/models/Series.js"></script>
<script src="/assets/js/components/tvShowCard.js"></script>

<?php if(isset($scripts)){
    echo $scripts;
}?>
</body>

</html>