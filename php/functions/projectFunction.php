<script>
        $(document).ready(function(e){
            $("#search").keyup(function(){
                $("#searchbox").show();
                var text = $(this).val();
                $.ajax({
                    type: 'GET',
                    url: searchUrl,
                    data: 'txt=' + text,
                    success: function(data){
                        $("#searchbox").html(data);
                    }
                });
            })
        });

        window.onload=function() {
        var text_input = $('#search');
        text_input.trigger('keyup');
        }
</script>