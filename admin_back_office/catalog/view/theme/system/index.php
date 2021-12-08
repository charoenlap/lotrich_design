<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<div class="card">
	<div class="card-body">
		<div class="container">
			<form action="<?php echo $action;?>" method="POST" enctype="multipart/form-data">
				<div class="row mb-3">
					<div class="col-md-12">
						<h4>จัดการระบบ</h4>
					</div>
				</div>
				<?php if($result){?>
					<div class="alert alert-success text-success">บันทึกเรียบร้อย</div>
				<?php } ?>
				<?php foreach($setting['detail'] as $val){ ?>
				<div class="row mt-4">
					<div class="col-3">
						<?php echo $val['desc']; ?>
					</div>
					<div class="col-6">
						<?php if($val['input_type']=='file'){?>
							<input type="file" name="<?php echo $val['name'];?>">
							<?php if($val['val']){?>
							<br><br>
							<img src="../<?php echo $val['val'];?>" alt="" width="100px" height="100px">
							<?php } ?>
						<?php }else if($val['input_type']=='textarea'){?>
							<textarea class="form-control" name="<?php echo $val['name'];?>" cols="30" rows="5"><?php echo $val['val'];?></textarea>
						<?php }else{?>
							<input class="form-control <?php echo $val['class'];?>" type="text" name="<?php echo $val['name'];?>" value="<?php echo $val['val'];?>">
						<?php } ?>
					</div>
				</div>
				<?php } ?>
				<div class="row mt-4">
					<div class="col-md-12">
						<input type="submit" class="btn btn-primary btn-block" value="บันทึก">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
