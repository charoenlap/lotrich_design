<div class="container">
	<div class="row">
		<div class="col-12 text-center">
			<h3>ผลรางวัล</h3>
		</div>
	</div>
	<div class="row mt-5">
		<div class="col-3 text-left">
			<input type="text" class="form-control" value="16-Oct-2021">
		</div>
		<div class="col-6 text-left">
			<a href="" class="btn btn-primary btn-block">เข้าสู่ระบบ คลิกที่นี่</a>
		</div>
		<div class="col-3 text-right">
			<button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#exampleModal" data-whatever="">ดูประกาศผลรางวัลออนไลน์</button>
		</div>
	</div>
	<hr>
	<?php foreach($category as $val){ ?>
	<div class="row mt-4">
		<div class="col-12">
			<h4><?php echo $val['name'];?></h4>
		</div>
		<?php if($val['type']){ ?>
		<div class="col-12">
			<div class="row">
				<?php foreach($val['type'] as $type){?>
				<div class="col-3 text-center">
					<div class="card">
						<div class="card-header">
					  		<?php echo $type['type']; ?>
					  	</div>
					  	<div class="card-body">
					    	<h5 class="card-title"><?php echo $type['result']; ?></h5>
					    	<p class="card-text"></p>
					  	</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<?php }else{?>
		<div class="col-12">
			<p>ยังไม่เปิดให้บริการ</p>
		</div>
		<?php } ?>
	</div>	
	<hr>
	<?php } ?>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ผลการออกรางวัลออนไลน์</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
			<div class="col-md-12">
				<p>ประจำงวดวันที่ 1 ตุลาคม 2564</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<iframe width="100%" height="315" src="https://www.youtube.com/embed/fTdZJ86KzLk?start=1290" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
