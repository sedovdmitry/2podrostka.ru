<script async src="https://yastatic.net/share2/share.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<!-- JavaScript -->
<script async src="./gzip-js/default.js"></script>
<!--<script src="gzip-js/bootstrap.js"></script>-->
<!-- Асинхронная загрузка VK -->
<div id="script_ad" class="script_ad" style="display:none;">
    <!-- Начало асинхронного скрипта -->
    <!-- VK Widget -->
    <div id="vk_groups"></div>
    <!-- Конец асинхронного скрипта -->
</div>
<script type="text/javascript">
    var vkBlock = document.getElementById("script_block");
    if (vkBlock) {
        // переместить его в реальную позицию отображения
        document.getElementById('script_block').appendChild(document.getElementById('script_ad'));
        // показать
        document.getElementById('script_ad').style.display = 'block';        
    }
</script>
<script>
    // Асинхронный код GA, через 10 секунд отправляет в GA сигнал, что страница еще открыта
    setTimeout("ga('send','event','Engaged users','More than 10 seconds')", 10000);
</script>
