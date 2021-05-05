<script>
    $(document).ready(function() {
        var datatale_cc = $('#todos_cc').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": "/centocusto/lista_todos_cc"
        });

        $(document).on('click', '.deleteCCusto', function(){  
           var user_id = $(this).attr("id");  
           if(confirm("Dseja deletar esse cento de custo?"))  
           {  
                $.ajax({  
                     url:"<?php echo site_url('/centocusto/deleta_cc'); ?>",  
                     method:"POST",  
                     headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                     data:{user_id:user_id},  
                     success:function(data)  
                     {  
                        confirm(data);
                        window.location.reload();  
                     }  
                });  
           }  
           else  
           {  
                return false;       
           }  
      });  

    });
</script>