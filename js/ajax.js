function eliminarPro(){var e=document.getElementById("id_producto").value;param={idProEliminar:e},$.ajax({data:param,url:"ctroAdmi.php",dataType:"html",method:"get",success:function(e){0===e?Swal.fire({icon:"error",title:"Oops...",text:"Something went wrong!",footer:'<a href="#">Why do I have this issue?</a>'}):document.getElementById("productos").innerHTML=e},error:function(e,o,t){console.log(t)}})}