$(document).ready(function(){
	$('.option').click(function(){
		var id = $(this).parent().siblings('.id').text();
		alert(id);
		var option = $(this).val();
		alert(option);
		$.post('../admin/lock.php',{id:id,option:option},function(data,textStatus,xhr){
			if(textStatus == 'success'){
				var data = $.parseJSON(data);
				if(data.error == '0'){
					alert(data.msg);
					window.location.reload();
				}else{
					alert(data.msg);
				}
			}
		});
	});








	var id = 0;
	$('.reply').click(function(){
		// alert('aaaaa');
		id = $(this).parent().siblings('.id').text();

		// alert(id);
		$('#replyid').val(id);

	});


	$('#sub').click(function(){
		var content =$('#replycontent').val();

		// alert(111);
		$.post('../admin/reply.php',{reply:content,id:id},function(data,textStatus,xhr){
			if(textStatus == 'success'){
				var data = $.parseJSON(data);
				alert(data.msg);
				window.location.reload();
			}
		});
	});
});