<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>สมาชิก</h1>
			<ul>
				<li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
				<li>สมาชิก</li>
			</ul>	
		</div>
	</div>
</section>
<div class="container mt-4">
	<div class="row mt-4">
		<div class="col-md-2">
			ผู้ใช้งาน : <span><?php echo $name.' '.$lname; ?></span><br>
			<span class="text-success"><?php echo number_format($balance,2); ?></span> บาท
		</div>
		<div class="col-md-10">
			<nav class="nav nav-pills nav-justified">
					<a href="<?php echo $link_widthdraw; ?>" class="nav-item nav-link text-danger">ถอนเงิน</a>
					<a href="<?php echo $link_deposit; ?>" class="nav-item nav-link text-success">ฝากเงิน</a>
					<a href="<?php echo $link_finance; ?>" class="nav-item nav-link text-warning">การเงิน</a>
					<a href="<?php echo $link_ticket; ?>" class="nav-item nav-link ">โพยหวย</a>
			</nav>
		</div>
	</div>
	
	<div class="row mt-4">
		<?php foreach($category as $val){ ?>
			<div class="col-lg-3 col-md-6">
				<div class="recent-news-single">
					<div class="news-thumbnail">
						<a href="<?php echo $link_lottery;?>"  style="background:url(uploads/flag/<?php echo $val['flag'];?>);width:100%;height:150px;background-size:cover;background-position: center;margin-right:10px;display:block;"></a>
					</div>
					<div class="news-content">
						<div class="news-meta">
							<!-- <span></span> -->
							<div class="load-btn mt-20">
								<a class="hvr-btn btn-block" href="<?php echo $link_lottery.'&id='.encrypt($val['id']);?>">
									<?php echo $val['name']; ?>
								</a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>