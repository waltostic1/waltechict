<script>
        $(document).ready(function () {

            $(document).ajaxStart(function(){
                $(".wait").css("display", "block");
            });
            
             $(document).ajaxComplete(function(){
                $(".wait").css("display", "none");
            });

        });
    </script>

<div class="text-center text-info wait" id="wait" style="display:none; width:100%; height:100%; 
    position:absolute; top:0%; left:0%; z-index:10; background-color:gray; background-image:url(img/loader.gif); opacity:0.6">
</div>