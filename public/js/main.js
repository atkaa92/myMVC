$("#search").click(function(){
  	var searchedText;
  	searchedText = $("#searchedText").val().replace(" ", "&");
  	location.replace("http://kar3n.com/users/search/" + searchedText);
});

$("#messsageBTN").click(function(){
	var messsage = $("#messsage").val();
	$("#messsage").val('');
	var mes_to_id = $("#mes_to_id").val();
	$.post("/users/addMessage", {messsage, mes_to_id}, function(data, status){
	}, "json")
});
$('#messsage').keydown(function (e) {
	  if (e.ctrlKey && e.keyCode == 13) {
			$( "#messsageBTN" ).trigger( "click" );
	   }
	});

function getMessagesAfter1Sec() {
	var mes_to_id = $("#mes_to_id").val();
	var lastId = $(".messageListItem:last-child").data("message-id");
	$.post("/users/newMessages", {lastId, mes_to_id}, function(data, status){
		if (data != '1') {
			$.each(data, function( k, v ) {
				var pull = ''; var pullText = '';
				if ( mes_to_id == v.to_id) {
					pull = ' pull-right';
					pullText = ' pull-right text-right';
				}
				$(".messageList").append(
					'<div class="row messageListItem" data-message-id="' + v.id + '">'+
						'<div class="col-sm-1' + pull + '">'+
							// '<a>'+ v.f_name +'</a><br><br>'+
							'<img src="../../public/uploads/avatar/'+ v.avatar +'" width="45px" style="border: 1px solid #000; border-radius:100%;">'+
						'</div>'+
						'<div class="col-sm-11' + pullText + '">'+
								'<small><i>' + v.created_at + '</i></small>'+
							'<b><p class="well" style="padding: 3px 10px; margin-bottom: 3px;">' + v.body + '</p></b>'+
						'</div>'+
					'</div>'
				)
			  });
		}
	}, "json")
}

setInterval(function(){ getMessagesAfter1Sec(); }, 300);

