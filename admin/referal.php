
<script>
	$(function() {
		$( "#datepicker_join_date" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>
<script>
	$(function() {
		$( "#datepicker_dob" ).datepicker({
			changeMonth: true,
			changeYear: true
		});
	});
	</script>
<script>
function editrefererpopup(id,tablename,rowid){
	$("#add_referer_submit").hide();
	$("#edit_referer_submit").show();
	
	
	$.ajax({ type: "POST",url: "ajax_get_referer_info.php",async: true,data: "id="+id+"&table="+tablename, success: function(data)
		{
			data=data.split("?#?");
			if(parseInt(data[0]))
			{
				console.log(data[1]);
				var referdata=data[1].split("#@#");
				var update_refer_type=referdata[0];
				var update_refer_name=referdata[1];
				var update_under_super=referdata[2];
				var update_employee_id=referdata[3];
				var update_mobile=referdata[4];
				var update_gender=referdata[5];
				var update_age=referdata[6];
				var update_address=referdata[7];
				var update_email=referdata[8];
				
				$("#referer_refer_type").val(update_refer_type);
				$("#referer_doctor_name").val(update_refer_name);
				if(parseInt(update_under_super))
				{
				document.getElementById("referer_show_tr5").checked = true;
				document.getElementById("referer_show_tr6").checked = false;
				referer_check_val_tr5();
				}
				else
				{
				document.getElementById("referer_show_tr5").checked = false;
				document.getElementById("referer_show_tr6").checked = true;
				referer_check_val_tr5();
				}
				
				$("#referer_employee_id").val(update_employee_id);
				$("#refer_mobile").val(update_mobile);
				$("#refer_gender").val(update_gender);
				$("#referer_dob").val(update_age);
				$("#referer_address").val(update_address);
				$("#referer_email").val(update_email);
				
				$("#referer_table_id").val(id);
				document.getElementById('msg_popup_referer').innerHTML='';
				
				
				
				
			}
			else
			alert("Something wrong to fetching your edit data");
			
		}
	})	
	
	
	return false;
}
</script>
<script>
function deleterefererpopup(id,tablename,rowid){

$.ajax({ type: "POST",url: "ajax_delete_referer.php",async: true,data: "id="+id+"&table="+tablename, success: function(data)
		{
			if(parseInt(data))
			{
				document.getElementById('msg_popup_delete_referer').innerHTML="<span style='color:red'>Referer Data Deleted successfully</span>";
				$("#"+rowid).remove();
				//showPlan2(document.getElementById('referer_refer_type').value);
				
				$("#add_referer_submit").show();
				$("#edit_referer_submit").hide();
				
				
				refer_form_popup.reset();
				$("#referer_table_id").val(0);
			}
			else
			alert("Something wrong");
			
		}
	})	
	
}
</script>
</script>
<script>
function referer_submit(){

var refertype=document.getElementById("referer_refer_type").value;
var joindate=document.getElementById("datepicker_join_date").value;
var refername=document.getElementById("referer_doctor_name").value;
if (document.getElementById('referer_show_tr5').checked==true) 
 {
 var  undersuper = document.getElementById("referer_show_tr5").value;
 }
 else
 {
var  undersuper = document.getElementById("referer_show_tr6").value;	 
 }
//var undersuper=document.getElementById("referer_show_tr5").value;
var employeeid=document.getElementById("referer_employee_id").value;
var mobile=document.getElementById("refer_mobile").value;
var gender=document.getElementById("refer_gender").value;
var dob=document.getElementById("referer_dob").value;
var address=document.getElementById("referer_address").value;
var email=document.getElementById("referer_email").value;
var referer_table_id=document.getElementById("referer_table_id").value;
$.ajax({ type: "POST",url: "ajax_referer_add.php",async: false,data: "referertableid="+encodeURIComponent(referer_table_id)+"&refer_type="+encodeURIComponent(refertype)+"&join_date="+encodeURIComponent(joindate)+"&refer_name="+encodeURIComponent(refername)+"&under_super="+encodeURIComponent(undersuper)+"&employee_id="+encodeURIComponent(employeeid)+"&mobile="+encodeURIComponent(mobile)+"&gender="+encodeURIComponent(gender)+"&dob="+encodeURIComponent(dob)+"&address="+encodeURIComponent(address)+"&email="+encodeURIComponent(email), success: function(data)
		{
		
			data=data.split("#");
			if(parseInt(data[0]))
			{
			if($("#referer_table_id").val()==0)	
			document.getElementById('msg_popup_referer').innerHTML="<span style='color:green'>Referer successfully added</span>";
			else
			document.getElementById('msg_popup_referer').innerHTML="<span style='color:green'>Referer successfully updated</span>";
			//$('#refertable tbody').append(");
			if(referer_table_id==0)
			{
			var randno=Math.random();
			randno=Math.round(randno*200);
            $('#refertable >tbody:last').append("<tr id='referer"+randno+"'><td>"+randno+"</td><td>"+joindate.toString()+"</td><td>MAA/"+refertype+"/"+data[1]+"</td><td>"+refername+"</td><td colspan='2'><a href='javascript:void(0)' onclick='return editrefererpopup(&quot;"+data[1]+"&quot;,&quot;refer_master&quot;,&quot;referer"+randno+"&quot;);'>Edit</a>&nbsp;<a href='javascript:void(0)' onclick='return deleterefererpopup(&quot;"+data[1]+"&quot;,&quot;refer_master&quot;,&quot;referer"+randno+"&quot;);'>Delete</a></td></tr>"); 
			}
			else
			{
				$("#add_referer_submit").show();
				$("#edit_referer_submit").hide();
				$("#referer_tr5").hide();
			}
			//showPlan2(document.getElementById('referer_refer_type').value);
			refer_form_popup.reset();
			$("#referer_table_id").val(0);
			
			}
			else
			alert('Something wrong to add referer');
			
		}
	})
	

return false;
}
</script>
<script type="text/javascript">
function referer_check_val_tr5()
{
if(document.getElementById('referer_show_tr5').checked==true)
{
$('#referer_tr5').show('slow');
}

if(document.getElementById('referer_show_tr6').checked==true)
{
$('#referer_tr5').hide('slow');
}
}
</script> 

<div id="referal" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false"  style="height:auto">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="refer_form_popup.reset();$('#referer_table_id').val(0);referer_check_val_tr5();document.getElementById('msg_popup_referer').innerHTML='';document.getElementById('msg_popup_delete_referer').innerHTML='';" >×</button>
			<h3>Add Referrer</h3>
		  </div>
          <div>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp <a href="javascript:void(0);" onclick="refer_form_popup.reset();$('#referer_table_id').val(0);referer_check_val_tr5();$('#add_referer_submit').show();$('#edit_referer_submit').hide();" class="btn btn-success">Add New</a>
          </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm" onsubmit="return referer_submit();" name="referer_form" id="refer_form_popup">
            <div id="msg_popup_referer">
             </div>
            <input type="hidden" id="referer_table_id" name="referer_table_id" value="0" />
           
            <table width="80%" border="0" style="margin-left:10%;">
  			<tr>
              <td> <div class="control-group">
				<select name="referer_refer_type" id="referer_refer_type">
                  <option value="">Select Referrer Type</option>
                  <option value="DOC" selected="selected">Doctor</option>
                  <option value="AGE">Agent</option>
                  <!--<option value="MAR">Marketing</option>
                  <option value="SEL">Self</option>
                  <option value="DEP">Department</option>-->
                </select>
			  </div></td>
              <td><div class="control-group">								
				<input style="display:none;" type="text" name="referer_join_date" id="datepicker_join_date" placeholder="Date of Joining" value="<?php echo date('d/m/Y');?>"/>
			  
				<input type="text" name="referer_refer_name" id="referer_doctor_name" placeholder="Referer Name"/>
			  </div></td>
            </tr>
            <tr>
             <td><div class="control-group">
              <strong>Under Supervision</strong>
				<span style="margin-left:0px;"><input type="radio" name="referer_under_super" id="referer_show_tr5" value="1"  onClick="referer_check_val_tr5();"/>&nbsp;Yes</span>
      <span style="margin-left:0px;"><input type="radio" name="referer_under_super" value="0" id="referer_show_tr6" checked="checked" onClick="referer_check_val_tr5();"/>&nbsp;No.</span>
			  </div>
               <div class="control-group" id="referer_tr5" style="display:none;">
				<select name="referer_employee_id" id="referer_employee_id"/>
                  <option value="0">..Select Employee Id</option>
                    <?php
                    $sql = "SELECT * FROM emp_master where status='1'";
                    $result = mysql_query($sql);
                    while($row = mysql_fetch_array($result)){
                    ?>
                                  <option value="<?php //echo $row['employee_id']?>"><?php //echo $row['employee_id']?> - (<?php //echo $row['employee_name']; ?>)</option>
                    <?php
                    }
                    ?>
               </select>
			  </div></td>
             <td><div class="control-group">
				<input type="text" name="mobile" id="refer_mobile" placeholder="Contact no"/>
			  </div> </td>
            </tr>
             <tr>
             <td><div class="control-group">
				<select name="referer_gender" id="refer_gender">
                  <option value="">Select Gender</option>
                  <option value="1" selected="selected">M</option>
                  <option value="0">F</option>
                </select>
			  </div></td>
             <td><div class="control-group">
				<input type="text" name="referer_dob" id="referer_dob" <?php /*?>id="datepicker_dob"<?php */?> placeholder="Age in Years"/>
			  </div></td>
            </tr>
             <tr>
             <td><div class="control-group">
				<input type="text" name="referer_address" id="referer_address" placeholder="Address"/>
			  </div> </td>
             <td><div class="control-group">
				<input type="text" name="referer_email" id="referer_email" placeholder="Email"/>
			  </div> </td>
            </tr>
            
             <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><button id="add_referer_submit" type="submit" class="btn btn-success">Add Referrer</button><button id="edit_referer_submit" style="display:none;" type="submit" class="btn btn-success">Edit Referer</button>&nbsp;<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></td>
            </tr>
            </table>
            
			  
			  
             
               
               
               
               
                
			  <!--<div class="control-group">
				<label class="checkbox">
				<input type="checkbox"> Remember me
				</label>
			  </div>-->
              <br>
            
			
			</form>		
			
            
            <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
			 <div id="msg_popup_delete_referer">
             </div>
            <table class="table table-hover table-striped table-bordered" id="refertable">
                <thead>
                  <tr>
                    <th><strong>Sl No.</strong></th>
                    <th><strong>Date of Joining</strong></th>
                    <th><strong>Referrer Id</strong></th>
                    <th><strong>Referrer Name</strong></th>
                    <th colspan="2">Options</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$sql="SELECT * FROM refer_master where status='1' ORDER BY id DESC";
				$result=mysql_query($sql);
				$c=1;
				while($row=mysql_fetch_array($result))
				{
				?>        

                <tr id="referer<?php echo $c;?>">
                  <td><?php echo $c;?></td>
                  <td><?php echo $row["join_date"]; ?></td>
                  <td><?php echo $row["refer_id"]; ?></td>
                   <td><?php echo $row["refer_name"]; ?></td>
                  <td colspan="2"><a href="javascript:void(0);" onclick="return editrefererpopup('<?php echo $row["id"];?>','refer_master','referer<?php echo $c;?>');" >Edit&nbsp;</a><a href="javascript:void(0)" onclick="return deleterefererpopup('<?php echo $row["id"];?>','refer_master','referer<?php echo $c;?>');">Delete</a></td>
                
                </tr>
               <?php 
				$c=$c+1;
				}
				?>
				</tbody>
                 
              </table>
			</div>
		
		
			  	

		
            
            
		  </div>
	</div>