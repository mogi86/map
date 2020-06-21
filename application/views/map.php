<!DOCTYPE html>
<html lang="ja">
<head>
<title>位置情報取得</title>
<?php include(APPPATH . 'views/header.php'); ?>
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
	  alert("こんにちは");
	// テキストボックスへ値を設定します
	    $("#inputEmail5").val(lat_lng.lat());
	});
  </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDEDAH6xL6TeOYlIfKZ0Tuiy1PM8f14eRc" async defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

</body>
</html>
