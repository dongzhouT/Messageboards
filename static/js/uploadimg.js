$(function() {
	var btnUpload = $('#upload');
	//	var status=$('#status');
	new AjaxUpload(btnUpload, {
		action: 'uploaddo.php',
		name: 'uploadfile',
		responseType: 'json', //用json返回数据
		onSubmit: function(file, ext) {
			if (ext && /^(jpg|png|jpeg|gif|bmp)$/.test(ext)) {
				this.setData({
					'info': '文件类型为图片'
				});
			} else {
				$('#divpicview1').html('<font class="red">非图片类型文件，请重传</font>');
				//status.text('非图片类型文件，请重传');
				return false;
			}
			$('#divpicview1').html('<font class="red">文件上传中...</font>');
		},
		onComplete: function(file, response) {
			//On completion clear the status
			$('#divpicview1').html('');
			//Add uploaded file to list
			if (response.success) {
				$('#wimg1').val(response.imgpath);
				$('#wimgnm1').val(response.real_name);
				document.getElementById("avatar1").src = response.imgpath;
				$('#divpicview1').html('<font class="green">上传成功！</font>');
				//$('#wimg1').val(response.fname);
				//$('#divpicview').html('<img src="'+response.fname+'" style=" width:360px" />');

			} else {
				$('#divpicview1').html(response.message);
			}
			// this.disable();
		}
	});
});