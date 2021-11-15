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
<div class="container mt-4 lotto">
	<div class="row mt-4">
		<div class="col-12 col-md-2 text-center">
			ผู้ใช้งาน : <span><?php echo $name.' '.$lname; ?></span><br>
			<span class="text-default"><?php echo number_format($balance,2); ?></span> บาท
		</div>
		<div class="col-12 col-md-10">
			<nav class="nav nav-pills nav-justified">
				<a href="<?php echo $link_deposit; ?>" class="nav-item nav-link text-default">ฝากเงิน</a>
				<a href="<?php echo $link_widthdraw; ?>" class="nav-item nav-link text-danger">ถอนเงิน</a>
				<a href="<?php echo $link_finance; ?>" class="nav-item nav-link text-warning">การเงิน</a>
				<a href="<?php echo $link_ticket; ?>" class="nav-item nav-link ">โพยหวย</a>
			</nav>
		</div>
	</div>
	
	<div class="row mt-4">
		<?php foreach($category as $val){ ?>
			<?php 
				$class="col-lg-6";
				if($val['sub']){ $class="col-lg-12"; } ?>
			<div class="<?php echo $class;?> col-md-6">
				<div class="card mb-4">
					<div class="card-header">
						<h3 style="line-height: 30px;display:inline-block;color:#fff;">
							<?php if(!$val['sub']){ ?>
							<a href="<?php echo $link_package.'&id='.encrypt($val['id']);?>">
								<?php if($val['flag']){ ?>
								<img src="uploads/flag/<?php echo $val['flag'];?>" width="50px" height="30px"> 
								<?php } ?>
								<?php echo $val['name']; ?>
							</a>
							<?php }else{?>
								<img src="uploads/flag/<?php echo $val['flag'];?>" width="50px" height="30px"> 
								<?php echo $val['name']; ?>
							<?php } ?>
						</h3>
						<?php if(!$val['sub']){ ?>
						<div  class="text-center" style="float:right">ปิด: <?php echo $val['date_close']; ?></div>
						<?php }?>
					</div>
					<div class="card-body">
						<?php if($val['sub']){ ?>
							<div class="row">
							<?php foreach($val['sub'] as $v){?>
								<div class="col-6 col-md-3">
									<div class="sub-card card mt-2 mb-2">
										<div class="card-header">
											<h4 class="text-center" style="line-height: 30px;display:inline-block;color:#fff;">
												<a class="" href="<?php echo $link_package.'&id='.encrypt($v['id']);?>">
													<?php echo $v['name']; ?>
												</a>
											</h4>
										</div>
										<div class="card-body card-body-red">
											<div class="text-center" >ปิด: <?php echo $val['date_close']; ?></div>
											<?php /*<a class="hvr-btn btn-block" href="<?php echo $link_package.'&id='.encrypt($v['id']);?>">
												<?php echo $v['name']; ?>
											</a>*/ ?>
										</div>
									</div>
								</div>
							<?php }?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>