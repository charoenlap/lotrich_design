<section class="breadcamb-area bg-17 bg-overlay-1">
	<div class="container">
		<div class="bradcamb-content text-center text-white text-uppercase">
			<h1>แพคเกจ</h1>
			<ul>
				<li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
				<li><a href="<?php echo route('member/dashboard');?>">สมาชิก <span>/</span></a></li>
				<li>หวยจับยี่กี</li>
			</ul>	
		</div>
	</div>
</section>
<div class="container mt-4 lotto">
	<div class="row mt-4" id="sort">
		<?php 
			foreach($round['yeekee']['open'] as $val){ 
				$hour 	= $val['hour'];
				$min 	= $val['min'];
				$code 	= $val['code'];
		?>
		<div class="col-4 ">
			<div class="card mb-4">
				<div class="card-header text-center">
					รอบ <?php echo $hour.':'.$min; ?> 
				</div>
				<div class="card-body-red">
					<div class="text-center">
						<span class="time" time="<?php echo date('Y-m-d'); ?> <?php echo $hour.':'.$min; ?>"></span>
					</div>
					<a class="hvr-btn btn-block " href="<?php echo route('member/package&id='.$id.'&id_round='.encrypt($code)); ?>">
						เลือก
					</a>
				</div>
			</div>
		</div>
		<?php } ?>
		<?php 
			foreach($round['yeekee']['close'] as $val){ 
				$hour 	= $val['hour'];
				$min 	= $val['min'];
				$code 	= $val['code'];
		?>
		<div class="col-4 <?php echo $hour.$min; ?> ">
			<div class="card mb-4">
				<div class="card-header text-center">
					รอบ <?php echo $hour.':'.$min; ?> 
				</div>
				<div class="card-body-red">
					<div class="text-center">
						<span class="time" time="<?php echo date('Y-m-d'); ?> <?php echo $hour.':'.$min; ?>"></span>
					</div>
					<a class="hvr-btn btn-block " href="">
						เลือก
					</a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>
<script src="//cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
<script>
	$(function(){
		$( '.time' ).each(function( index,id ) {
		// $.each( '.time', function( i, val ) {
		// $.each('.time', function(index, val) {
			var time = $(this).attr('time');
			 $(this).countdown(time)
			.on('update.countdown', function(event) {
			  var format = '%H:%M:%S';
			  // if(event.offset.totalDays > 0) {
			  //   format = '%-D วัน%!d ' + format;
			  // }
			  // if(event.offset.weeks > 0) {
			  //   format = '%-w สัปดาห์%!w ' + format;
			  // }
			  $(this).html(event.strftime(format));
			})
			.on('finish.countdown', function(event) {
			  $(this).html('ปิดรับแทง')
			    .parent().addClass('disabled');
			});
			// sortTable($('#sort'),'asc');
		})
	});
	// function sortTable(table, order) {
	//     var asc   = order === 'asc',
	//         tbody = table.find('card-body-red');
	//     if(tbody.find('.time').length > 1 ){
	// 	    tbody.find('.time').sort(function(a, b) {
	// 	        if (asc) {
	// 	        	console.log()
	// 	            return $('.col-4:first', a).text().localeCompare($('.col-4:first', b).text());
	// 	    } else {
	// 	        return $('.col-4:first', b).text().localeCompare($('.col-4:first', a).text());
	// 	    }
	// 	    }).appendTo(tbody);
	// 	}
	// }
</script>