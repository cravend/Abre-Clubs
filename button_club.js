$(function(){
	$('.modal-newclub').leanModal({
		in_duration: 0,
		out_duration: 0,
		ready: function(){
		},
		complete: function() { $("#Description").val(""); $("#Information").val(""); }
	});
});
