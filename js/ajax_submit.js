$(document).ready(function(){
	$('#sub').click(function(){
		//alert('123');
		var nickname = $("#nickname").val();
	//	alert(nickname);
		var content = $("#content").val();
	//	alert(content);
		var email = $("#email").val();

	//	alert(email);

		if(nickname =="" || content==""){
			alert("用户名或昵称不能为空!");
			return false;
		}
		if (nickname.length > 10) {
			alert("nickname is too long!");

			return false;
		}

		if(content.length > 50){
			alert("content is too long!");

			return false;
		}else{
			var data = {
			nickname : nickname,
			content : content,
			email : ''
			};


			if (email !== "") {
				var email_reg = /\w+([-+.]\w+)*@\w+([-.]\w+)*.\w+([-.]\w+)*/;
				if(!email_reg.test(email)){
					alert("Email address not legal");
					return false;
				}else{
					data.email = email;
				}
			}


		}






		$.post('../lwdz/post.php',data,function(data,textStatus,xhr){
			if(textStatus == 'success'){
				var data = $.parseJSON(data);
				if(data.error == '0'){
					alert(data.msg);
					window.location.href = '?page=1';
				}else{
					alert(data.msg);
				}
			}
		});

		



		

	
	});
	


});