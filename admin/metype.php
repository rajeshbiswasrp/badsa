<script>
function metype_add(){

var categ_id=document.getElementById("categ_id").value;
var type_name=document.getElementById("type_name").value;
var id=document.getElementById("popup_metype_id").value;
//alert(id);
$.ajax({ type: "POST",url: "ajax_metype_add.php",async: false,data: "categ_id="+encodeURIComponent(categ_id)+"&type_name="+encodeURIComponent(type_name)+"&id="+id, success: function(data)
		{
			data=data.split("#");
			if(parseInt(data[0]))
			{
				
			if(id==0)
			{	
			document.getElementById('msg_popup_metype').innerHTML='<span style="color:green">Medicine Type successfully added</span>';
				
			var randno=Math.random();
			randno=Math.round(randno*200);
            $('#metypetable >tbody:last').append("<tr id='metype"+randno+"'><td>"+randno+"</td><td>"+categ_id.toString()+"</td><td>"+type_name.toString()+"</td><td colspan='2'><a href='javascript:void(0)' onclick='return editmetypepopup(&quot;"+data[1]+"&quot;,&quot;ph_type_master&quot;,&quot;metype"+randno+"&quot;);'>Edit</a>&nbsp;<a href='javascript:void(0)' onclick='return deletemetypepopup(&quot;"+data[1]+"&quot;,&quot;ph_type_master&quot;,&quot;metype"+randno+"&quot;);'>Delete</a></td></tr>"); 
             }
			 else
			 {
			 
			 document.getElementById('msg_popup_metype').innerHTML='<span style="color:green">Medicine Type successfully updated</span>';
			 $("#categ_id").val("");
			 $("#type_name").val("");
			 $("#popup_metype_id").val(0);
			 
			 }   
               		
			 
			$.ajax({ type: "POST",url: "ajex_showmetype.php",success: function(data)
			{
				document.getElementById("metype_id").innerHTML=data;
				
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
function editmetypepopup(id,tablename,rowid){
	$("#add_metype").hide();
	$("#edit_metype").show();
document.getElementById("popup_metype_id").value=id;	
	
	$.ajax({ type: "POST",url: "ajax_get_metype_info.php",async: true,data: "id="+id+"&table="+tablename, success: function(data)
		{
			data=data.split("?#?");
			if(parseInt(data[0]))
			{
				console.log(data[1]);
				
				var referdata=data[1].split("#@#");
				var update_categ_id=referdata[0];
				var update_type_name=referdata[1];
				
				
				$("#categ_id").val(update_categ_id);
				$("#type_name").val(update_type_name);
				
				$("#metype_table_id").val(id);
				document.getElementById('msg_popup_metype').innerHTML='';
				
				$.ajax({ type: "POST",url: "ajex_showmetype.php",success: function(data)
			{
				document.getElementById("metype_id").innerHTML=data;
				
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
function deletemetypepopup(id,tablename,rowid){

$.ajax({ type: "POST",url: "ajax_delete_metype.php",async: true,data: "id="+id+"&table="+tablename, success: function(data)
		{
			if(parseInt(data))
			{
				document.getElementById('msg_popup_delete_metype').innerHTML="<span style='color:red'>Medicine Type Data Deleted successfully</span>";
				$("#"+rowid).remove();
				
				$("#metype_table_id").val(0);
				
				$.ajax({ type: "POST",url: "ajex_showmetype.php",success: function(data)
			{
				document.getElementById("metype_id").innerHTML=data;
				
			}
			})
			}
			else
			alert("Something wrong");
			
		}
	})	
	
}
</script>



<div id="metype" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false"  style="height:auto">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="refer_form_popup.reset();$('#metype_table_id').val(0);metype_check_val_tr5();document.getElementById('msg_popup_metype').innerHTML='';document.getElementById('msg_popup_delete_metype').innerHTML='';" >×</button>
			<h3>Add Type</h3>
		  </div>
          <div>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp <a href="javascript:void(0);" onclick="refer_form_popup.reset();$('#metype_table_id').val(0);metype_check_val_tr5();$('#add_metype').show();$('#edit_metype').hide();" class="btn btn-success">Add New</a>
          </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm"  name="popup_metype_form" id="popup_metype_form">
            <div id="msg_popup_metype">
             </div>
           
            <table width="70%" border="0" style="margin-left:10%;">
             <tr>
             
               <td><div class="control-group">
               <select name="categ_id" id="categ_id" style="width:190px; margin-left:1px;">
     
     <?php
	 $sql="SELECT * FROM ph_category_master";
	 $result=mysql_query($sql);
	 while($row=mysql_fetch_assoc($result)){
	?>
      <option value="<?php echo $row['id'];?>"><?php echo $row['categ_name'];?></option>
    <?php
	 }
	 ?>
      </select>
			  </div> </td>
               <td><div class="control-group">
				<input type="text" name="type_name" id="type_name" placeholder="Type Name"/>
                <input type="hidden" name="popup_metype_id" id="popup_metype_id" value="0"  />
			  </div> </td>
            </tr>
            
             <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><button id="add_metype" onclick="return metype_add();" type="button" class="btn btn-success">Add</button><button id="edit_metype" onclick="return metype_add();" style="display:none;" type="button" class="btn btn-success">Edit Type</button>&nbsp;<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></td>
            </tr>
            </table>
            
              <br>
            
			
			</form>		
			
            
            <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
			 <div id="msg_popup_delete_metype">
             </div>
            <table class="table table-hover table-striped table-bordered" id="metypetable">
                <thead>
                  <tr>
                    <th><strong>Sl No.</strong></th>
                     <th><strong>Category Name</strong></th>
                     <th><strong>Medicine Type</strong></th>
                    <th colspan="2">Options</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$sql="SELECT * FROM ph_type_master where status='1' ORDER BY id DESC";
				$result=mysql_query($sql);
				$c=1;
				while($row=mysql_fetch_array($result))
				{
				$c_id=$row["categ_id"];
$sql2="SELECT * FROM ph_category_master where id='$c_id'";
$result2=mysql_query($sql2);
while($row2=mysql_fetch_array($result2))
{
?>        

                <tr id="metype<?php echo $c;?>">
                  <td><?php echo $c;?></td>
                  <td><?php echo $row2["categ_name"]; ?></td>
                  <td><?php echo $row["type_name"]; ?></td>
                  <td colspan="2"><a href="javascript:void(0);" onclick="return editmetypepopup('<?php echo $row["id"];?>','ph_type_master','metype<?php echo $c;?>');" >Edit&nbsp;</a><a href="javascript:void(0)" onclick="return deletemetypepopup('<?php echo $row["id"];?>','ph_type_master','metype<?php echo $c;?>');">Delete</a></td>
                
                </tr>
               <?php 
				$c=$c+1;
				}
				}
				?>
				</tbody>
                 
              </table>
			</div>
		
		
			  	

		
            
            
		  </div>
	</div>