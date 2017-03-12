<?php include 'News.php'; ?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <title>RSS-Reader</title>
</head>

<body>
<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <?php foreach ($data as $key => $new) { ?>
        <h3><?php echo $new['title']; ?></h3>
        <p><?php echo $new['description']; ?>
            <a href="<?php echo $new['link']; ?>">Детальніше</a>
            </p>
                <div>
                <span><?php echo $new['pub_date']; ?></span>
                </div>
            <hr>
        <?php } ?>
    </div>
</div>
</body>
</html>