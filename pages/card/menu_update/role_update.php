
<?php include("../database.php");  ?>
<div class="row">
	<div id="breadcrumb" class="col-xs-12">
		<a href="#" class="show-sidebar">
			<i class="fa fa-bars"></i>
		</a>
		<ol class="breadcrumb pull-left">
			<li><a href="index.php">Dashboard</a></li>
			<li><a href="#">User & Security</a></li>
			<li><a href="#">Role Update</a></li>
		</ol>
		
	</div>
</div>
<div class="row">
	
	
	<div class="col-xs-7">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Role Update</span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content no-padding">
					<form id="defaultForm" name="info" method="post" action="ajax/userSecurity/menu_update/role_update_confirm.php" class="form-horizontal">
						<fieldset>
						<legend>Sub Menu  Update From  Role</legend>
						

						<div class="form-group">
							<label class="col-sm-4 control-label" required="required">Role Name</label>
							<div class="col-sm-6">
							<select class=""   name="role_name" id="role_name" >
									<option value="">-- Select a Role --</option>
								 <?php 
								 $role_query = mysql_query("SELECT sl, role_name from role_table where role_name <> '' ");

								 while($role_result = mysql_fetch_array($role_query))
								 {
								 	?>
								 		<option value="<?php echo $role_result['sl'] ?>"><?php echo $role_result['role_name']; ?></option>
								 		
								 	<?php
								 }


								 ?>
								</select>
							</div>
						</div>

						<div id="fetch_result">

							
									
						</div>

						<div class="form-group">
						<div class="col-sm-6 col-sm-offset-3 text-center" >
							<input type="submit" class="btn btn-primary" value="UPDATE"></input>
						</div>
					</div>		
					 
					</fieldset>
					</form>
					
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
// Run Select2 plugin on elements
function DemoSelect2(){
	//$('#s2_with_tag').select2({placeholder: "Select OS"});
	$('#agnt').select2();
	$('#org').select2();
	$('#trnTp').select2();


}
// Run timepicker
function DemoTimePicker(){
	$('#input_time').timepicker({setDate: new Date()});
}

function AllTables(){
	TestTable1();
	TestTable2();
	TestTable3();
	LoadSelect2Script(MakeSelect2);
}

function MakeSelect2(){
	$('select').select2();
	$('.dataTables_filter').each(function(){
		$(this).find('label input[type=text]').attr('placeholder', 'Search');
	});
}
 


$(document).ready(function() {
	// Create Wysiwig editor for textare
	TinyMCEStart('#wysiwig_simple', null);
	TinyMCEStart('#wysiwig_full', 'extreme');
	// Add slider for change test input length
	FormLayoutExampleInputLength($( ".slider-style" ));
	// Initialize datepicker
	$('#input_date').datepicker({setDate: new Date()});
	$('#input_date1').datepicker({setDate: new Date()});

	// Load Timepicker plugin
	LoadTimePickerScript(DemoTimePicker);
	// Add tooltip to form-controls
	$('.form-control').tooltip();
	LoadSelect2Script(DemoSelect2);
	// Load example of form validation
	LoadBootstrapValidatorScript(DemoFormValidator);
	// Add drag-n-drop feature to boxes
	
	LoadDataTablesScripts(AllTables);
	// Load Datatables and run plugin on tables 
	
	WinMove();
});

$('#role_name').on('change', function(){
	var role_id = $('#role_name').val();

	$.ajax({
		url:'ajax/userSecurity/menu_update/fetch_menu.php',
		type:'Post',
		data:{'role_id': role_id },
		success:function(data)
		{
			$('#fetch_result').html(data);
		}
	});
})




</script>


