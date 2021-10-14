<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>สมาชิก</h1>
			<ul>
				<li><a href="index.html">หน้าหลัก <span>/</span></a></li>
				<li>สมาชิก</li>
			</ul>	
		</div>
	</div>
</section>
<div class="container mt-4">
	<div class="row mt-4">
		<div class="col-md-2">
			ผู้ใช้งาน : <span>xx</span><br>
			<span class="text-success">0.00</span> บาท
		</div>
		<div class="col-md-10">
			<nav class="nav nav-pills nav-justified">
					<a href="<?php echo $link_deposit; ?>" class="nav-item nav-link text-success">ฝากเงิน</a>
					<a href="<?php echo $link_widthdraw; ?>" class="nav-item nav-link text-danger">ถอนเงิน</a>
					<a href="<?php echo $link_reward; ?>" class="nav-item nav-link ">ผลรางวัล</a>
					<a href="<?php echo $link_ticket; ?>" class="nav-item nav-link ">โพยหวย</a>
					<a href="<?php echo $link_finance; ?>" class="nav-item nav-link ">การเงิน</a>
			</nav>
		</div>
	</div>
	
	<div class="row mt-4">
		<?php foreach($category as $val){ ?>
			<div class="col-lg-4 col-md-6">
				<div class="recent-news-single">
					<div class="news-thumbnail">
						<a href="<?php echo $link_lottery;?>"><img src="uploads/other/huay-1.png" alt=""></a>
					</div>
					<div class="news-content">
						<div class="news-meta">
							<span>26 Nov 2021</span>
							<div class="load-btn mt-20">
								<a class="hvr-btn" href="<?php echo $link_lottery;?>"><?php echo $val['name']; ?></a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>