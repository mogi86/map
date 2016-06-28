<!DOCTYPE html>
<html lang="ja">
<head>
<title>図書館検索</title>
<?php include(APPPATH . 'views/header.php'); ?>
</head>
<body>

<?php include(APPPATH . 'views/nabvar.php'); ?>

    <div class="container">
        <form class="form-horizontal" action="<?php echo base_url(); ?>betelgeuse/searchbook" method="get">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">書籍名</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail1" name="book_name" placeholder="書籍名 ※一部指定可">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">下記図書館で書籍を探す</button>
                </div>
            </div>
            <?php if (!empty($library_data)) { ?>
            <?php $serial_num = 0; ?>
            <?php foreach ($library_data as $row) { ?>
            <?php $serial_num++; ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo $row['formal']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="something">
                            <td>ホームページ</td>
                            <td><a href="<?php echo "{$row['url_pc']}"; ?>"><?php echo $row['url_pc']; ?></a></td>
                        </tr>
                        <tr class="something">
                            <td>住所</td>
                            <td><?php echo $row['address']; ?></td>
                        </tr>
                        <tr class="something">
                            <td>電話番号</td>
                            <td><?php echo $row['tel']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- hidden start-->
            <input type="hidden" name="system_id[]" value="<?php echo $row['systemid']; ?>">
            <input type="hidden" name="formal[]" value="<?php echo $row['formal']; ?>">
            <!-- hidden end-->
            
            <?php } ?>
            <?php } else {
                echo "該当する図書館無いよ！！！";
            } ?>
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</body>
</html>
