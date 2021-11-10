<section class="breadcamb-area bg-17 bg-overlay-1">
    <div class="container">
        <div class="bradcamb-content text-center text-white text-uppercase">
            <h1>ลืมรหัสผ่าน</h1>
            <ul>
                <li><a href="<?php echo route('home'); ?>">หน้าหลัก <span>/</span></a></li>
                <li>ลืมรหัสผ่าน</li>
            </ul>   
        </div>
    </div>
</section>
<div class="page-wrap d-flex flex-row align-items-center">
    <div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <form role="form" id="form-forgot" action="<?php echo $action;?>" method="POST">
    		    รหัสผ่านใหม่ของท่านจะถูกส่งเข้าไปยัง อีเมลที่ท่านได้สมัครไว้ และสามารถกดยืนยันการใช้รหัสผ่านได้ในอีเมลของท่าน ท่าจะสามารถใช้รหัสผ่านใหม่เพื่อเข้าสู่ระบบไปเปลี่ยนรหัสผ่านได้ หากมีปัญหาสามารถติดต่อได้ที่ช่องทาง Line <a href="<?php echo $link_line;?>">หรือ คลิกที่นี่ </a> ให้ผู้ดูแลระบบได้ตรวจสอบ ยินดีให้บริการ 24 ชม
    		    <form action="<?php echo $action; ?>" class="mt-3" id="form-forgot">
    		        <input class="form-control" type="email" name="email" placeholder="กรุณาใส่อีเมลของท่าน xx@gmail.com"/>
                    <div class="load-btn mt-20">
                        <input type="submit" class="hvr-btn btn-block" value="ยืนยันการเปลี่ยนรหัสผ่าน" id="btn-submit">
                    </div>
    		    </form>
    		</div>
    	</div>
    </div>
</div>
<div class="position-fixed top-0 right-0 p-3" style="z-index: 99; right: 0; bottom: 0;">
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bi bi-arrow-bar-down"></i>
        <strong class="mr-auto">ผลลัพธ์</strong>
        <!-- <small>11 mins ago</small> -->
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body"></div>
    </div>
</div>
<script>
    $(document).on('submit','#form-forgot',function(e){
        var ele = $(this);
        $('#btn-submit').prop('disabled', true);
        $('#btn-submit').attr('aria-disabled', true);
        $('#btn-submit').addClass('disabled');
        $('#btn-submit').removeClass('hvr-btn');
        $.ajax({
            url: ele.attr('action'),
            type: 'POST',
            dataType: 'json',
            data: ele.serialize(),
        })
        .done(function(result) {
            console.log("success");
            console.log(result);
            if(result.status=='failed'){
                $('#btn-submit').prop('disabled', false);
                $('#btn-submit').attr('aria-disabled', false);
                $('#btn-submit').removeClass('disabled');
                $('#btn-submit').addClass('hvr-btn');
                $('.toast-body').text(result.desc);
                $('.toast-body').addClass('text-danger');
                $('.toast-body').removeClass('text-success');
                $('#toast').toast('show');
            }else{
                $('.toast-body').removeClass('text-danger');
                $('.toast-body').addClass('text-success');
                $('.toast-body').text(result.desc);
                $('#toast').toast('show');
                setInterval(function(){ 
                    window.location='index.php?route=login'; 
                }, 3000);
            }
        })
        .fail(function(a,b,c) {
            console.log("error");
            console.log(a);
            console.log(b);
            console.log(c);
            $('.toast-body').removeClass('text-success');
            $('.toast-body').addClass('text-danger');
            $('.toast-body').text('การทำงานล้มเหลว'+a.responseText);
            $('#toast').toast('show');
        })
        .always(function() {
            console.log("complete");
        });
        e.preventDefault();
    });
</script>