<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 
	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
	        		<?php
	        			if(isset($_SESSION['error'])){
	        				echo "
	        					<div class='alert alert-danger'>
	        						".$_SESSION['error']."
	        					</div>
	        				";
	        				unset($_SESSION['error']);
	        			}
	        		?>
	        		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
		                <ol class="carousel-indicators">
		                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
		                  <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
		                </ol>
		                <div class="carousel-inner">
		                  <div class="item active">
		                    <img src="images/1.jpg" alt="First slide"style="width: 100%; height: auto;">
		                  </div>
		                  <div class="item">
		                    <img src="images/2.jpg" alt="Second slide"style="width: 100%; height: auto;">
		                  </div>
		                  <div class="item">
		                    <img src="images/3.jpg" alt="Third slide"style="width: 100%; height: auto;">
		                  </div>
		                </div>
		                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
		                  <span class="fa fa-angle-left"></span>
		                </a>
		                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
		                  <span class="fa fa-angle-right"></span>
		                </a>
		            </div>
		            <h2>Favorite products</h2>
		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
	       							</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
	        	</div>
		

	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  	<!-- About Us Section -->
<section id="aboutus" class="py-5" style="scroll-margin-top: 80px;">
  <div class="container">
    <h1 class="text-center mb-4">Về Chúng Tôi</h1>
    <div class="row justify-content-center">
      <div class="col-md-10">
        <p>
          Chào mừng bạn đến với <strong>CerAMC</strong> – cửa hàng chuyên cung cấp các dòng cốc gốm sứ thủ công cao cấp, nơi hội tụ giữa nghệ thuật và sự tinh tế trong từng chi tiết.
        </p>
        <p>
          Với mong muốn mang đến những sản phẩm không chỉ đẹp mà còn chứa đựng giá trị văn hóa, CerAMC cam kết:
        </p>
        <ul>
          <li>🌿 Chất liệu gốm sứ an toàn, thân thiện với môi trường</li>
          <li>🎨 Thiết kế độc đáo, mang dấu ấn thủ công truyền thống</li>
          <li>💝 Dịch vụ khách hàng tận tâm, hỗ trợ nhanh chóng</li>
        </ul>
        <p>
          Dù bạn là người yêu thích nghệ thuật sống chậm hay đang tìm món quà tinh tế cho người thân, chúng tôi tin rằng những chiếc cốc tại CerAMC sẽ làm bạn hài lòng.
        </p>
        <p class="mt-4">
          Cảm ơn bạn đã ghé thăm và ủng hộ CerAMC!
        </p>
      </div>
    </div>
  </div>
</section>
  	<?php include 'includes/footer.php'; ?>
</div>
	
<?php include 'includes/scripts.php'; ?>
</body>
</html>