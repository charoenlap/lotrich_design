<form action="<?php echo $action; ?>" method="GET">	
	<input type="hidden" name="route" value="report/accounting">
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
			<div class="row mt-4">
				<div class="col-12">
					<table class="table">
						<tbody>
							<tr>
								<td>รายได้</td>
							    <td class="text-end"><?php echo $result['income'];?></td>
							</tr>
							<tr>
								<td>รายจ่าย</td>
							    <td class="text-end"><?php echo $result['expenses'];?></td>
							</tr>
							<tr>
								<td>กำไร</td>
							    <td class="text-end text-<?php echo ($result['diff']=="+"?'success':'danger'); ?>"><?php echo $result['diff'].' '.$result['profit'];?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<?php foreach($yeekee['yeekee'] as $val){?>
					<div class="col-2 mb-4">
						<?php echo $val['hour'].':'.$val['min'] ?><br>
						<div class=" text-<?php echo ($yeekee_result[$val['code']]['diff']=="+"?'success':'danger'); ?>">
							<?php echo $yeekee_result[$val['code']]['diff'].' '.$yeekee_result[$val['code']]['profit'];?>
						</div>
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