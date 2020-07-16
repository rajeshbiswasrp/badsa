<script>
function category_add(){

var categ_name=document.getElementById("categ_name").value;
var id=document.getElementById("popup_category_id").value;
//alert(id);
$.ajax({ type: "POST",url: "ajax_category_add.php",async: false,data: "categ_name="+encodeURIComponent(categ_name)+"&id="+id, success: function(data)
		{
			data=data.split("#");
			if(parseInt(data[0]))
			{
				
			if(id==0)
			{	
			document.getElementById('msg_popup_category').innerHTML='<span style="color:green">Category successfully added</span>';
				
			var randno=Math.random();
			randno=Math.round(randno*200);
            $('#categorytable >tbody:last').append("<tr id='category"+randno+"'><td>"+randno+"</td><td>"+categ_name.toString()+"</td><td colspan='2'><a href='javascript:void(0)' onclick='return editcategorypopup(&quot;"+data[1]+"&quot;,&quot;ph_category_master&quot;,&quot;category"+randno+"&quot;);'>Edit</a>&nbsp;<a href='javascript:void(0)' onclick='return deletecategorypopup(&quot;"+data[1]+"&quot;,&quot;ph_category_master&quot;,&quot;category"+randno+"&quot;);'>Delete</a></td></tr>"); 
             }
			 else
			 {
			 
			 document.getElementById('msg_popup_category').innerHTML='<span style="color:green">Category successfully updated</span>';
			 $("#categ_name").val("");
			 $("#popup_category_id").val(0);
			 
			 }   
               		
			 
			$.ajax({ type: "POST",url: "ajex_showcategory.php",success: function(data)
			{
				document.getElementById("category_id").innerHTML=data;
				
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
function editcategorypopup(id,tablename,rowid){
	$("#add_category").hide();
	$("#edit_category").show();
document.getElementById("popup_category_id").value=id;	
	
	$.ajax({ type: "POST",url: "ajax_get_category_info.php",async: true,data: "id="+id+"&table="+tablename, success: function(data)
		{
			data=data.split("?#?");
			if(parseInt(data[0]))
			{
				console.log(data[1]);
				
				var referdata=data[1].split("#@#");
				var update_categ_name=referdata[0];
				
				
				$("#categ_name").val(update_categ_name);
				
				$("#category_table_id").val(id);
				document.getElementById('msg_popup_category').innerHTML='';
				
				$.ajax({ type: "POST",url: "ajex_showcategory.php",success: function(data)
			{
				document.getElementById("category_id").innerHTML=data;
				
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
function deletecategorypopup(id,tablename,rowid){

$.ajax({ type: "POST",url: "ajax_delete_category.php",async: true,data: "id="+id+"&table="+tablename, success: function(data)
		{
			if(parseInt(data))
			{
				document.getElementById('msg_popup_delete_category').innerHTML="<span style='color:red'>Category Data Deleted successfully</span>";
				$("#"+rowid).remove();
				
				$("#category_table_id").val(0);
				
				$.ajax({ type: "POST",url: "ajex_showcategory.php",success: function(data)
			{
				document.getElementById("category_id").innerHTML=data;
				
			}
			})
			}
			else
			alert("Something wrong");
			
		}
	})	
	
}
</script>



<div id="category" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false"  style="height:auto">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="refer_form_popup.reset();$('#category_table_id').val(0);category_check_val_tr5();document.getElementById('msg_popup_category').innerHTML='';document.getElementById('msg_popup_delete_category').innerHTML='';" >×</button>
			<h3>Add Category</h3>
		  </div>
          <div>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp <a href="javascript:void(0);" onclick="refer_form_popup.reset();$('#category_table_id').val(0);category_check_val_tr5();$('#add_category').show();$('#edit_category').hide();" class="btn btn-success">Add New</a>
          </div>
		  <div class="modal-body">
			<form class="form-horizontal loginFrm"  name="popup_category_form" id="popup_category_form">
            <div id="msg_popup_category">
             </div>
           
            <table width="70%" border="0" style="margin-left:10%;">
             <tr>
             
               <td><div class="control-group">
				<input type="text" name="categ_name" id="categ_name" placeholder="Category Name"/>
                <input type="hidden" name="popup_category_id" id="popup_category_id" value="0"  />
			  </div> </td>
               <td>&nbsp;</td>
            </tr>
            
             <tr>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
            </tr>
            <tr>
            <td>&nbsp;</td>
            <td><button id="add_category" onclick="return category_add();" type="button" class="btn btn-success">Add</button><button id="edit_category" onclick="return category_add();" style="display:none;" type="button" class="btn btn-success">Edit Category</button>&nbsp;<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button></td>
            </tr>
            </table>
            
              <br>
            
			
			</form>		
			
            
            <div class="row-fluid" style="background-color:#fff; padding:10px 10px 10px 10px; font-size:14px; text-align:justify; line-height:25px; width:98%;">
			 <div id="msg_popup_delete_category">
             </div>
            <table class="table table-hover table-striped table-bordered" id="categorytable">
                <thead>
                  <tr>
                    <th><strong>Sl No.</strong></th>
                     <th><strong>Category Name</strong></th>
                    <th colspan="2">Options</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$sql="SELECT * FROM ph_category_master where status='1' ORDER BY id DESC";
				$result=mysql_query($sql);
				$c=1;
				while($row=mysql_fetch_array($result))
				{
?>        

                <tr id="category<?php echo $c;?>">
                  <td><?php echo $c;?></td>
                  <td><?php echo $row["categ_name"]; ?></td>
                  <td colspan="2"><a href="javascript:void(0);" onclick="return editcategorypopup('<?php echo $row["id"];?>','ph_category_master','category<?php echo $c;?>');" >Edit&nbsp;</a><a href="javascript:void(0)" onclick="return deletecategorypopup('<?php echo $row["id"];?>','ph_category_master','category<?php echo $c;?>');">Delete</a></td>
                
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