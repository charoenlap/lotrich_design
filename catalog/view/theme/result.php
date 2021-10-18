<section class="breadcamb-area bg-17 bg-overlay-1">
    <div class="container">
        <div class="bradcamb-content text-center text-white text-uppercase">
            <h1>ผลรางวัล</h1>
            <ul>
                <li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
                <li>ผลรางวัล</li>
            </ul>   
        </div>
    </div>
</section>
<div class="container">
	<div class="row mt-5">
		<div class="col-6 col-md-2 text-left">
			<input type="text" class="form-control" value="16-Oct-2021">
		</div>
		<div class="col-6 col-md-10 text-right">
			<a href="" class="btn ">เข้าสู่ระบบ คลิกที่นี่</a>
		</div>
	</div>
	<?php foreach($category as $val){ ?>
	<div class="row mt-4">
		<div class="col-12">
			<h4><?php echo $val['name'];?></h4>
		</div>
		<?php if($val['type']){ ?>
				<?php foreach($val['type'] as $type){?>
				<div class="col-6 col-xs-6 col-sm-4 col-md-4 col-lg-3 text-center mb-2">
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
		<?php }else{?>
		<div class="col-12">
			<p>ยังไม่เปิดให้บริการ</p>
		</div>
		<?php } ?>
	</div>	
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
