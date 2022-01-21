<?php include("../../../database_2.php");  ?>
<?php 
$role_id =  $_POST['role_id'];

 ?>

 <div class="form-group">
	<label class="col-sm-4 control-label" required="required">Sub Menu Name</label>
	<div class="col-sm-6">
	<select class="" multiple="multiple"  name="menu_name[]" id="menu_name" >
			<option value="">-- Select a Menu --</option>
		  <?php
		  $menus=mysql_query("SELECT * FROM  `menu_table` WHERE link <>  '#' and sl<>2 and role NOT  like '%$role_id%'");
		  while($menu_result=mysql_fetch_array($menus))
		  	{ 
		  		?>

				<option value="<?php echo $menu_result['sl'] ?>"><?php echo $menu_result['menu_name']?></option>
				<?php 
			} 
			?>
		</select>
	</div>
</div>



<script type="text/javascript">



function AllTables(){
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


</script>



