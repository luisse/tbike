<script type="text/javascript" src="/js/jquery.js"></script>
<form enctype="multipart/form-data" id="formuploadajax" method="post">
        Nombre: <input type="text" name="nombre" placeholder="Escribe tu nombre">
        <br />
        <input  type="file" id="picture" name="picture"/>
        <br />
        <input  type="file" id="archivo2" name="archivo2"/>
        <br />
        <input type="submit" value="Subir archivos"/>
    </form>
    <div id="mensaje"></div>
<script>
$(function(){
        $("#formuploadajax").on("submit", function(e){
            e.preventDefault();
            var f = $(this);
            var formData = new FormData(document.getElementById("formuploadajax"));
            //alert(formData);
            //formData.append("dato", "valor");
            //formData.append(f.attr("name"), $(this)[0].files[0]);
            $.ajax({
                url: "/users/updateimageremote.json",
                headers: {
          				'Security-Access-Token':'4b81e66e035f97f14ddadd75811e94a4d0120b8d',
          				'Security-Access-PublicToken':'A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S'
          			},
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
	     processData: false
            })
                .done(function(res){
                    $("#mensaje").html("Respuesta: " + res);
                });
        });
    });
</script>
