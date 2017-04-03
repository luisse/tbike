<?php if (Configure::read('debug') == 2) { ?>

    <style type="text/css">
        .cake-sql-log { display: none; }
    </style>
    <script language="javascript">
        <!--
        $(document).ready(function() {
            $("#sql_toggle").click(function() {
                $('.cake-sql-log').toggle();

            });
        });    
        -->
    </script>
    <a href="#" id="sql_toggle">[Expand/Collapse SQL]</a>

<?php } ?>