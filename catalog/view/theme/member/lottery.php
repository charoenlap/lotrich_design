<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>แทงหวย รัฐบาล</h1>
			<ul>
				<li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
				<li><a href="<?php echo route('member/dashboard');?>">สมาชิก <span>/</span></a></li>
				<li>แทงหวย รัฐบาล</li>
			</ul>	
		</div>
	</div>
</section>
<div class="container mt-4">
	<div class="row">
	    <div class="col-md-3 mt-2">
	    	<div class="card height" style="height:100%;">
	    		<div class="card-header">
	    			1. เลือกประเภท
	    		</div>
	    		<div class="card-body">
			    	เลือกชนิด
			    	<div class="form-check">
					  <input class="form-check-input" type="radio" name="rdoType" id="rdo1" checked>
					  <label class="form-check-label" for="rdo1">
					    3 บน
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="rdoType" id="rdo2">
					  <label class="form-check-label" for="rdo2">
					    3 ล่าง
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="rdoType" id="rdo3">
					  <label class="form-check-label" for="rdo3">
					    3 โต๊ด
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="rdoType" id="rdo4">
					  <label class="form-check-label" for="rdo4">
					    2 บน
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="rdoType" id="rdo5">
					  <label class="form-check-label" for="rdo5">
					    2 ล่าง
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" type="radio" name="rdoType" id="rdo6">
					  <label class="form-check-label" for="rdo6">
					    2 โต๊ด
					  </label>
					</div>
			    	<br>
			    	<div class="form-check">
					  <input class="form-check-input" type="checkbox" name="check" id="check">
					  <label class="form-check-label" for="check">
					    + เพิ่มกลับ
					  </label>
					</div>
			    </div>
			</div>
	    </div>
	    <div class="col-md-3 mt-2">
	    	<div class="card height" style="height:100%;">
	    		<div class="card-header">
	    			2. ใส่ราคา
	    		</div>
	    		<div class="card-body">
	    			ใส่เลข
			    	<div class="row">
			    		<div class="col-4">
			    			<input type="text" class="form-control">
			    		</div>
			    		<div class="col-4">
			    			<input type="text" class="form-control">
			    		</div>
			    		<div class="col-4">
			    			<input type="text" class="form-control">
			    		</div>
			    	</div>
			    	ใส่ราคา (บาท)
			    	<input type="text" class="form-control">
			    	<a href="#" class="btn btn-success btn-block mt-2">ส่งเข้าโพย >> </a>
	    		</div>
	    	</div>
	    </div>
	    <div class="col-md-6 mt-2">
	    	<div class="card height" style="height:100%;">
	    		<div class="card-header">
	    			3. โพย
	    		</div>
	    		<div class="card-body">
			    	การแทง
			    	<table class="table">
			    		<thead>
			    			<th>ประเภท</th>
			    			<th>เลข</th>
			    			<th>แทง</th>
			    			<th>จ่าย</th>
			    			<th>ชนะ</th>
			    			<th>ลบ</th>
			    		</thead>
			    		<tbody>
		 					<tr>
			    				<td>สองตัว</td>
			    				<td>20</td>
			    				<td>100</td>
			    				<td>90</td>
			    				<td>9000</td>
			    				<td><a href="" class="btn btn-danger btn-xs">ลบ</a></td>
			    			</tr>
			    		</tbody>
			    	</table>
			    </div>
			</div>
	    </div>				
	</div>
	<div class="row mt-4">
		<div class="col-12">
			<div class="load-btn mt-20">
	        	<button type="submit" class="hvr-btn btn-block">ส่งโพยยืนยันการแทง</button>
	        </div>
		</div>
	</div>
</div>