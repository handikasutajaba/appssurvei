<div class="col-12">
<div class="ibox">
    <div class="ibox-head">
        <div class="ibox-title"><?= $title;?></div>
        <div class="ibox-tools">
            <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
        </div>
    </div>
    <div class="ibox-body">
		<form method="post" id="form-validation" action="javascript:;" novalidate="novalidate">
            <input type="hidden" name="id" value="<?= $kategori['_id']; ?>">
			<div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Kategori Survei</label>
                <div class="col-sm-6">
                    <input class="form-control" type="text" name="kt_survei" value="<?= $kategori['kt_survei']; ?>" placeholder="Nama Kategori Survei" autocomplete="off">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 ml-sm-auto">
                	<a href="javascript:void(0)" class="btn btn-warning" onclick="backButton()"><i class="fa fa-history"></i> Back</a>
                    <button class="btn btn-info submit" type="botton" name="submit"> <i class="fa fa-save"></i> Submit</button>
                </div>
            </div>
		</form>
	</div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function (){
        $("#form-validation").validate({
            rules: {
                kt_survei:{
                    required: !0,
                    minlength: 4
                },
            },
            messages:{
                kt_survei:{
                    required:"Kategori Survei harus diisi",
                    minlength:"Kategori Survei Minimal 4 Karakter"
                },
            },
            errorClass: "help-block error",
            highlight: function(e) {
                $(e).closest(".form-group.row").addClass("has-error")
            },
            unhighlight: function(e) {
                $(e).closest(".form-group.row").removeClass("has-error")
            },
            submitHandler:function(form){
                var kt_survei = $('input[name=kt_survei]').val();
                var id = $('input[name=id]').val();
                $.ajax({
                    type: "POST",
                    url : "<?= base_url('admin/updatekategorisurvei')?>",
                    data: {<?= csrf_token() ?>:'<?= csrf_hash() ?>',kt_survei:kt_survei, id:id},
                    success: function(msg){
                        var msg = eval('('+msg+')');
                        if (msg.errorMsg){
                            Swal.fire(
                                'Error!',
                                ''+msg.errorMsg+'.',
                                'error'
                              )
                        } else {
                            Swal.fire(
                                'Sukses!',
                                ''+msg.message+'.',
                                'success'
                              )
                            window.setTimeout(function(){
                              window.location.href="<?= base_url('admin/kategorisurvei')?>";
                            },1000);
                        }
                    },
                    error:function(msg)
                    {
                        console.log(msg);
                    }
                }); 
            }
        });
    });
    
    function backButton()
    {
        var pathparts = location.pathname.split('/');
        window.location = location.origin+'/'+pathparts[1].trim('/')+'/kategorisurvei';
    }
</script>