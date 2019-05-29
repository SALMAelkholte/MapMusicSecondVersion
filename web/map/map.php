<div class="carte" id="world-map" style="height: 800px"></div>
<script>
    $(function () {
        $('#world-map').vectorMap({
            map: 'world_merc',
            backgroundColor: '',
            onRegionClick: function (event, code) {
                var codePays = (code);
                window.location.href = "index.php?c=" + codePays;
            },
        });
    });
</script>