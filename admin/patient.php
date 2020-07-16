<script>
function patient_add(){

var pati_name=document.getElementById("pati_name").value;
var address=document.getElementById("address").value;
var mobile=document.getElementById("mobile").value;
var email=document.getElementById("email").value;
var id=document.getElementById("popup_patient_id").value;
//alert(id);
$.ajax({ type: "POST",url: "ajax_patient_add.php",async: false,data: "pati_name="+encodeURIComponent(pati_name)+"&address="+encodeURIComponent(address)+"&mobile="+encodeURIComponent(mobile)+"&email="+encodeURIComponent(email)+"&id="+id, success: function(data)
		{
			data=data.split("#");
			if(parseInt(data[0]))
			{
				
			if(id==0)
			{	
			document.getElementById('msg_popup_patient').innerHTML='<span style="color:green">Patient successfully added</span>';
				
			var randno=Math.random();
			randno=Math.round(randno*200);
            $('#patienttable >tbody:last').append("<tr id='patient"+randno+"'><td>"+randno+"</td><td>"+pati_name.toString()+"</td><td>"+address.toString()+"</td><td>"+mobile.toString()+"</td><td>"+email.toString()+"</td><td colspan='2'><a href='javascript:void(0)' onclick='return editpatientpopup(&quot;"+data[1]+"&quot;,&quot;ph_patient_master&quot;,&quot;patient"+randno+"&quot;);'>Edit</a>&nbsp;<a href='javascript:void(0)' onclick='return deletepatientpopup(&quot;"+data[1]+"&quot;,&quot;ph_patient_master&quot;,&quot;patient"+randno+"&quot;);'>Delete</a></td></tr>"); 
             }
			 else
			 {
			 
			 document.getElementById('msg_popup_patient').innerHTML='<span style="color:green">Disease successfully updated</span>';
			 $("#pati_name").val("");
			 $("#address").val("");
			 $("#mobile").val("");
			 $("#email").val("");
			 $("#popup_patient_id").val(0);
			 
			 }   
               		
			 
			$.ajax({ type: "POST",url: "ajex_showpatient.php",success: function(data)
			{
				document.getElementById("patient_id").innerHTML=data;
				
			}
			})	
			
				
			}
			else
			alert("Something wrong to fetching your edit data");
			
		}
	})	
	
	
	return false;

}
</script>
<script>
function editpatientpopup(id,tablename,rowid){
	$("#add_patient").hide();
	$("#edit_patient").show();
document.getElementById("popup_patient_id").value=id;	
	
	$.ajax({ type: "POST",url: "ajax_get_patient_info.php",async: true,data: "id="+id+"&table="+tablename, success: function(data)
		{
			data=data.split("?#?");
			if(parseInt(data[0]))
			{
				console.log(data[1]);
				
				var referdata=data[1].split("#@#");
				var update_pati_name=referdata[0];
				var update_address=referdata[1];
				var update_mobile=referdata[2];
				var update_email=referdata[3];
				
				
				$("#pati_name").val(update_pati_name);
				$("#address").val(update_address);
				$("#mobile").val(update_mobile);
				$("#email").val(update_email);
				
				$("#patient_table_id").val(id);
				document.getElementById('msg_popup_patient').innerHTML='';
				
				$.ajax({ type: "POST",url: "ajex_showpatient.php",success: function(data)
			{
				document.getElementById("patient_id").innerHTML=data;
				
			}
			})
				
			}
			else
			alert("Something wrong to fetching your edit data");
			
		}
		
		
	})	
	
	
	return false;
}
</script>
<script>
function deletepatientpopup(id,tablename,rowid){

$.ajax({ type: "POST",url: "ajax_delete_patient.php",async: true,data: "id="+id+"&table="+tablename, success: function(data)
		{
			if(parseInt(data))
			{
				document.getElementById('msg_popup_delete_patient').innerHTML="<span style='color:red'>Patient Data Deleted successfully</span>";
				$("#"+rowid).remove();
				
				$("#patient_table_id").val(0);
				
				$.ajax({ type: "POST",url: "ajex_showpatient.php",success: function(data)
			{
				document.getElementById("patient_id").innerHTML=data;
				
			}
			})
			}
			else
			alert("Something wrong");
			
		}
	})	
	
}
</script>



<div id="patient" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false"  style="height:auto">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="refer_form_popup.reset();$('#patient_table_id').val(0);patient_check_val_tr5();document.getElementById('msg_popup_patient').innerHTML='';document.getElementById('msg_popup_delete_patient').innerHTML='';" >×</button>
			<h3>Add Customer</h3>
		  </div>
          <div>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp <a href="javascript:void(0);" onclick="refer_form_popup.reset();$('#patient_table_id').val(0);patient_check_val_tr5();$('#add_patient').show();$('#edit_patient').hide();" class="btn btn-success">Add New</a>
          </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm"  name="popup_patient_form" id="popup_patient_form">
            <div id="msg_popup_patient">
             </div>
           
            <table width="70%" border="0" style="margin-left:10%;">
             <tr>
             <td><div class="control-group">
				<input type="text" name="pati_name" id="pati_name" placeholder="Customer Name"/>
			  </div> </td>
               <td><div class="control-group">
				<input type="text" name="address" id="address" placeholder="Address"/>
			  </div> </td>
            </tr>
            <tr>
             <td><div class="control-group">
				<input type="text" name="mobile" id="mobile" placeholder="Mobile No."/>
			  </div> </td>
               <td><div class="control-group">
				<input type="text" name="email" id="email" placeholder="Email"/>
                <input type="hidden" name="popup_patient_id" id="popup_patient_id" value="0"  />
			  </div> </td>
            </tr>
            
             <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><button id="add_patient" onclick="return patient_add();" type="button" class="btn btn-success">Add</button><button id="edit_patient" onclick="return patient_add();" style="display:none;" type="button" class="btn btn-success">Edit Patient</button>&nbsp;<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></td>
            </tr>
            </table>
            
              <br>
            
			
			</form>		
			
            
            <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
			 <div id="msg_popup_delete_patient">
             </div>
            <table class="table table-hover table-striped table-bordered" id="patienttable">
                <thead>
                  <tr>
                    <th><strong>Sl No.</strong></th>
                     <th><strong>Customer Name</strong></th>
                     <th><strong>Address</strong></th>
                     <th><strong>Mobile No.</strong></th>
                     <th><strong>Email</strong></th>
                    <th colspan="2">Options</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$sql="SELECT * FROM ph_patient_master where status='1' ORDER BY id DESC";
				$result=mysql_query($sql);
				$c=1;
				while($row=mysql_fetch_array($result))
				{
?>        

                <tr id="patient<?php echo $c;?>">
                  <td><?php echo $c;?></td>
                  <td><?php echo $row["pati_name"]; ?></td>
                  <td><?php echo $row["address"]; ?></td>
                  <td><?php echo $row["mobile"]; ?></td>
                  <td><?php echo $row["email"]; ?></td>
                  <td colspan="2"><a href="javascript:void(0);" onclick="return editpatientpopup('<?php echo $row["id"];?>','ph_patient_master','patient<?php echo $c;?>');" >Edit&nbsp;</a><a href="javascript:void(0)" onclick="return deletepatientpopup('<?php echo $row["id"];?>','ph_patient_master','patient<?php echo $c;?>');">Delete</a></td>
                
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