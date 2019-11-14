var inputComponent='<div class="col-md-12 input-component" style="">'+
	'<div class="col-md-11" >'+
		'<input type="text" name="this[]" class="sourceData text-input" placeholder="Instagram link..." required>'+
	'</div>'+
	'<div class="col-md-1">'+
		'<span class="deleteInput delete-input-component glyphicon glyphicon-remove" aria-hidden="true"></span>'+
	'</div>'+
'</div>';

$("#addMoreButton").click(function(){
	$("#inputContainer").append(inputComponent);
});

$( "#submitButton" ).click(function(e) {
	e.preventDefault();
	var urlList=[];
	$(".sourceData").each(function(){
		if($(this).val() != ""){
			urlList.push($(this).val());
		}
	});

	$("#submitButton").hide();
	$("#postSubmitLoader").show();
	$.post('http://192.168.2.116/project/InstagramPostsReporting/instagram.php',{
		data:urlList
	},function(response){
		var response = jQuery.parseJSON(response);
		if(response.success){
			$("#postSubmitLoader").hide();
			$("#downloadLink").attr("href",response.data);

			$("#clearFields").show();
			$("#downloadLink").show();
		}
	});
});

$(document).on("click",".deleteInput",function() {
  $(this).parent().parent().remove();
});

$(document).on("click","#clearFields",function() {
  $(".sourceData").val("");
  $(".hideOnLoad").hide();
  $("#submitButton").show();
});
