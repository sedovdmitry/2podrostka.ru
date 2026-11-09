<?php /* Cookie notice banner (152-ФЗ). Подключается из parts/footer-scripts.php — присутствует на всех страницах сайта. */ ?>
<style>
#cookie_banner {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 9999;
  background: #103354;
  color: #ffffff;
  font-size: 13px;
  line-height: 1.5;
  padding: 10px 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 16px;
  box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.35);
}
#cookie_banner a {
  color: #9cc9e8;
  text-decoration: underline;
}
#cookie_accept {
  flex-shrink: 0;
  background: #ffffff;
  color: #103354;
  border: none;
  border-radius: 4px;
  padding: 6px 18px;
  font-size: 13px;
  font-weight: 700;
  cursor: pointer;
}
#cookie_accept:hover {
  background: #e8eef4;
}
@media (max-width: 767px) {
  #cookie_banner {
    flex-direction: column;
    gap: 8px;
    text-align: center;
    padding: 12px;
  }
}
</style>
<div id="cookie_banner">
  <span>Мы используем файлы cookie и системы веб-аналитики для сбора технических данных и улучшения работы сайта. Продолжая просмотр, вы соглашаетесь с <a href="/privacy/" target="_blank">Политикой обработки персональных данных</a>.</span>
  <button id="cookie_accept" type="button">Понятно</button>
</div>
<script>
(function () {
  var banner = document.getElementById('cookie_banner');
  if (!banner) { return; }
  if (/(?:^|;\s*)cookie_consent=1(?:;|$)/.test(document.cookie)) {
    banner.style.display = 'none';
    return;
  }
  document.getElementById('cookie_accept').addEventListener('click', function () {
    document.cookie = 'cookie_consent=1; max-age=' + 30 * 86400 + '; path=/';
    banner.style.display = 'none';
  });
})();
</script>
