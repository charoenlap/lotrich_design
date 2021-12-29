<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>แพคเกจ</h1>
			<ul>
				<li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
				<li><a href="<?php echo route('member/dashboard');?>">สมาชิก <span>/</span></a></li>
				<li><?php echo $detail['name'];?> <span>/</span> </li>
				<li>เลือกแพคเกจ</li>
			</ul>	
		</div>
	</div>
</section>
<div class="container mt-4 lotto">
	<div class="row mt-4">
		<?php if($package){ ?>
			<?php foreach($package as $val){?>
				<div class="col-4">
					<div class="card">
						<div class="card-header text-center">
							<?php echo $val['name']; ?>
						</div>
						<div class="card-body-red">
							<a class="hvr-btn btn-block " href="<?php echo $link_lotto.'&id='.encrypt($id_lotto).'&package='.encrypt($val['id']);?>">
								เลือก
							</a>
						</div>
					</div>
				</div>
			<?php } ?>
		<?php }else{?>
			<div class="col-12 text-center">
				ไม่พบแพคเกจที่ตรงกับหมวดหมู่ที่ท่านเลือก <a href="<?php echo route('member/dashboard');?>" class="text-danger ">กลับคลิกที่นี่</a>
			</div>
		<?php } ?>
	</div>
	<div class="row mt-4">
		<div class="col-12">
			<a href="#" class="btn btn-block btn-rule" data-text='<?php echo $detail['detail']; ?>' data-bs-toggle="modal" data-bs-target="#exampleModal">กฎ และกติกาการเล่น</a>
		</div>
	</div>
</div>
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="exampleModalLabel">กฎ และกติกาการเล่น</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-block" data-bs-dismiss="modal">ยอมรับ</button>
      </div>
    </div>
  </div>
</div>
<script>
	$(document).on('click','.btn-rule',function(e){
		var ele = $(this);
		$('#modal-body').html( ele.attr('data-text') );
	});
</script>