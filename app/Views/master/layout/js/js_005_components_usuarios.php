<script>
    $(document).ready(function() {
        var datatale_cc = $('#lista_usuarios_do_admin').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            },
            "order": [
                [0, "desc"]
            ],
            "ajax": "/usuario_admin/lista_usuarios"
        });
    });
</script>