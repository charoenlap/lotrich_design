<form action="<?php echo $action; ?>" method="GET">	
	<input type="hidden" name="route" value="report/number">
	<div class="card">
		<div class="card-body">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<h4>รายงานดูยอดที่แทง</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-3">
						<div class="form-group">
							<label for="">เลือกวัน</label>
				            <div class="input-group date datetimepicker">
								<span class="input-group-addon btn btn-warning">
									<span class="fa fa-calendar"></span>
								</span>
								<input type="text" class="form-control" id="date" 
									name="date" value="<?php echo $date;?>"/>
							</div>
				         </div>
					</div>
					<div class="col-3">
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
					<div class="col-3">
						<div class="form-group">
							<label for="">เลือกประเภท</label>
				            <div class="input-group">
								<select name="type" class="form-control" id="type">
									<?php foreach($type as $val){?>
									<option value="<?php echo $val['id']; ?>" <?php echo ($id_type==$val['id']?'selected':''); ?>>
										<?php echo $val['type']; ?>
									</option>
									<?php } ?>
								</select>
							</div>
				         </div>
					</div>
					<div class="col-3">
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
					<table class="table table-striped">
						<thead>
							<th>วันที่</th>
							<th>ตัวเลข</th>
							<th>ยอดเงินรวม</th>
						</thead>
						<tbody>
							<?php foreach($result as $val){?>
								<tr>
									<td><?php echo $date;?></td>
									<td><?php echo $val['number'];?></td>
									<td><?php echo $val['sum_price'];?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<link href="assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
        $(".datetimepicker").datepicker({ 
        	format: 'yyyy-mm-dd' 
        });
    });
</script>