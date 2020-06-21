<!DOCTYPE html>
<html lang="ja">
<head>
<title>位置情報取得</title>
<?php include(APPPATH . 'views/header.php'); ?>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
html, body {
	height: 100%;
	margin: 0;
	padding: 0;
}

#map {
	height: 50%;
	width: 50%;
}
</style>
</head>
<body>

<?php include(APPPATH . 'views/nabvar.php'); ?>

    <div class="container">
        <div id="map" style="width: 100%; height: 400px"></div>
        <!--  <ul>
			<li>lat: <span id="lat"></span>
			</li>
			<li>lng: <span id="lng"></span>
			</li>
		</ul>
		-->
        <form class="form-horizontal" action="<?php echo base_url(); ?>betelgeuse/library" method="get">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">緯度</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail1" name="lat" placeholder="緯度">
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">経度</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail2" name="lng" placeholder="経度">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">近隣図書館検索</button>
                </div>
            </div>
        </form>
    </div>

<script>
    function initMap() {

        // マップの初期化
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 13,
            center: {lat: 35.6807251137039, lng: 139.76707935333252}
        });

        // クリックイベントを追加
        map.addListener('click', function(e) {
            getClickLatLng(e.latLng, map);
        });
    }

    function getClickLatLng(lat_lng, map) {

        // 座標を表示
        //document.getElementById('lat').textContent = lat_lng.lat();
        //document.getElementById('lng').textContent = lat_lng.lng();
        $(function() {
            //alert("STEP-1");
            // テキストボックスへ値を設定します
            $("#inputEmail1").val(lat_lng.lat());
            $("#inputEmail2").val(lat_lng.lng());

        });

        // マーカーを設置
        var marker = new google.maps.Marker({
            position: lat_lng,
            map: map
        });

        // 座標の中心をずらす
        // http://syncer.jp/google-maps-javascript-api-matome/map/method/panTo/
        map.panTo(lat_lng);
    }
</script>

<script>
    $(function() {
        // テキストボックスへ値を設定します
        $("#inputEmail5").val(lat_lng.lat());
    });
</script>

<!-- ref: https://getbootstrap.com/docs/4.5/getting-started/introduction/ -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1r7F8zrPEpzmAzP7yQXu3yBmQdlDV8xc"></script>

</body>
</html>
