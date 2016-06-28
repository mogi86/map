<!DOCTYPE html>
<html lang="ja">
<head>
<title>貸出状況</title>
<?php include(APPPATH . 'views/header.php'); ?>
</head>
<body>

<?php include(APPPATH . 'views/nabvar.php'); ?>

    <div class="container">
        <?php if (!empty($result)) { ?>
        <?php foreach ($result as $isbn => $isbn_list) { ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?php echo $isbn; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="something">
                        <td>図書館名称</td>
                        <td><?php echo $isbn_list['formal']; ?></td>
                    </tr>
                    <?php foreach ($isbn_list['libkey'] as $index => $status) { ?>
                    <tr class="something">
                        <td>貸出状況（場所：<?php echo $index; ?>）</td>
                        <td><?php echo $status; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <?php } ?>
        <?php } else {
            echo "借りれる本は無いよ！！！";
        } ?>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</body>
</html>
