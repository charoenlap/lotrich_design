<form action="<?php echo $action; ?>" method="GET">	
	<input type="hidden" name="route" value="report/all">
	<div class="card">
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h4>รายงานดูยอดที่แทง</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-2">
						<div class="form-group">
							<label for="">เลือกวันเริ่ม</label>
				            <div class="input-group date datetimepicker">
								<span class="input-group-addon btn btn-warning">
									<span class="fa fa-calendar"></span>
								</span>
								<input type="text" class="form-control" id="date" 
									name="date" value="<?php echo $date;?>"/>
							</div>
				         </div>
					</div>
					<div class="col-2"> 
						<div class="form-group">
							<label for="">เลือกวันสิ้นสุด</label>
				            <div class="input-group date datetimepicker">
								<span class="input-group-addon btn btn-warning">
									<span class="fa fa-calendar"></span>
								</span>
								<input type="text" class="form-control" id="date_end" 
									name="date_end" value="<?php echo $date_end;?>"/>
							</div>
				         </div>
					</div>
					<div class="col-2">
						<div class="form-group">
							<label for="">เลือกหมวด</label>
				            <div class="input-group">
								<select name="category" class="form-control" id="category">
									<?php foreach($category as $val){?>
									<option value="<?php echo $val['id']; ?>" <?php echo ($id_category==$val['id']?'selected':''); ?>>
										<?php echo $val['name']; ?>
									</option>
									<?php } ?>
								</select>
							</div>
				         </div>
					</div>
					<div class="col-1">
						<label for="">&nbsp;</label><br>
						<input type="submit" class="btn btn-primary" value="ค้นหา">
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<div class="card">
	<div class="card-body">
		<div class="container">
			<div class="row mt-4 table-responsive">
				
					<?php $all_sum = 0; ?>
					
							<?php foreach($result as $val){ ?>
								<div class="col-2">
									<b><?php echo $val['name'];?></b>
									<table class="myTable">
										<thead>
											<th>ตัวเลข</th>
											<th>ราคา</th>
										</thead>
										<tbody>
										<?php 
											$sum = 0; 
											foreach($val['list'] as $v){ 
												$sum+=$v['sum_price']; ?>
												
														<tr>
															<td>
																<a href="index.php?route=report/bill&type=<?php echo  $val['id'];?>&number=<?php echo  $v['number'];?>&date=<?php echo $date;?>&date_end=<?php echo $date_end;?>">
																	<?php echo $v['number'];?>
																</a>
															</td>
															<td>
																<?php echo $v['sum_price'];?>
															</td>
														</tr>
													
											<?php } ?>
										</tbody>
									</table>
								</div>
							<?php } ?>

			</div>
			<!-- <div class="row">
				<div class="col-12">
					<p><label for="">จำนวนเงินรวมทั้งหมด: <?php echo  number_format($all_sum);?></label></p>
				</div>
			</div> -->
		</div>
	</div>
</div>

<link href="assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<link href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
	    $('.myTable').DataTable({
	    	"paging": false,
	    	"searching": false,
	    	"bInfo" : false
	    });
	} );
	$(document).ready(function(){
        $(".datetimepicker").datepicker({ 
        	format: 'yyyy-mm-dd' 
        });
    });
</script>