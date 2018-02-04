	<div class='fixed-action-btn buttonpin'>
		<a class='modal-newclub btn-floating btn-large waves-effect waves-light' style='background-color: <?php echo getSiteColor(); ?>' href='#newclub'><i class='large material-icons'>add</i></a>
		<div class="mdl-tooltip mdl-tooltip--left" for="createcourse">New Club</div>
	</div>


<script>

	$(function(){
    	$('.modal-newclub').leanModal({
	    	in_duration: 0,
			  out_duration: 0,
	    	ready: function(){
		    	$('.modal-content').scrollTop(0);
		    	$("#Incident_Reload").val("Open");
		    	$("#conducttitle").text("New Club");
		    	$("#conductsubtitle").html('');
		    	$("#conduct_search").show();
					$("#conducttags").html("");
		    	$("#searchresults").show();
		    	$("#searchresults").html("");
		    	$("#conduct_footer").show();
					$("#duplicateIncident").hide();
		    	$("#setTimeButton").show();
		    	$("#conduct_consequence").hide();
					$("#studentsearch").val("");
					$('#studentsearch').prop('required',true);
		    	$('#office').prop('checked',false);
		    	$('#personal').prop('checked',false);
		    	$("input[name=Type]").prop("disabled", false);
					$("#Offence").prop("disabled", false);
					$("#Location").prop("disabled", false);
					$("#Description").prop("disabled", false);
					$("#Information").prop("disabled", false);
					$("#incidentDateDiv").show();
					$("#incidentTimeDiv").show();
					$('option:not(:selected)').removeAttr('disabled');
					$('select').find('option:first').attr('disabled', 'disabled');
					var d = new Date();
					var picker = $('#IncidentDate').pickadate('picker');
					picker.set('select', d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate());
					$("#IncidentDate").prop("disabled", false);
					$("#IncidentTime").prop("disabled", false);
					$("#Description").val('');
					$("#Information").val('');
					$("#IncidentDate").val('');
					$("#IncidentTime").val('');
					$("#Offence").val('');
					$("#Location").val('');
					$("#Incident_Student_ID").val('');
					$("#Incident_Student_IEP").val('');
					$("#Incident_Student_FirstName").val('');
					$("#Incident_Student_MiddleName").val('');
					$("#Incident_Student_LastName").val('');
					$("#Incident_Student_Building").val('');
					$("#Incident_Student_Code").val('');
					$("#Incident_Reload").val('');
					$("#Incident_ID").val('');
					$("#previousOffences").hide();
					$("#archiveIncident").hide();
					Materialize.updateTextFields();
					<?php if(superadmin() || AdminCheck($_SESSION['useremail'])){ ?>
									$("#conduct_consequence").show();
									$(".Consequence").prop("disabled", false);
									$("#addconsequencebutton").show();
									$(".ServeDate").prop("disabled", false);
									$(".ThruDate").prop("disabled", false);
									$(".NumberOfDaysServed").prop("disabled", false);
									$(".servedCheckbox").prop("disabled", false);
					<?php } ?>
					for(var i = 0; i < 8; i++){
						$("#Consequence"+i).val("");
						$("#Consequence_ID"+i).val("");
						$("#NumberOfDaysServed"+i).val("");
						$("#ServeDate"+i).val("");
						$("#ThruDate"+i).val("");
						$('#servedCheckbox'+i).prop('checked',false);
						$('#pdfOption'+i).val("");
						$('#pdfOption'+i).prop("disabled", false);
						if(i != 0){
							$("#"+i).hide();
							$("#"+i).addClass("toAdd");
						}
					}
					$('select').material_select();
		    },
		    complete: function() { $("#Description").val(""); $("#Information").val(""); }
    	});
  	});

</script>
