<div id="vk_groups" style="opacity: 0; transition: opacity 0.3s;"></div>
<script type="text/javascript">
  // Функция для lazy-load виджета
  function loadVKWidget() {
    if (document.getElementById('vk_groups').dataset.loaded) return; // Уже загружено

    // Создаём и добавляем скрипт openapi.js асинхронно
    const script = document.createElement('script');
    script.src = 'https://vk.com/js/api/openapi.js?169';
    script.async = true;
    script.onload = function() {
      VK.init({ apiId: 4040691, onlyWidgets: true });
      VK.Widgets.Group("vk_groups", {
        mode: 1,  // Минимальный режим
        width: 262,
        height: 200,
        no_cover: 1,  // Без обложки
        color1: "FFFFFF",
        color2: "000000",
        color3: "5181B8"
      }, 62738566);
      document.getElementById('vk_groups').dataset.loaded = 'true';
      document.getElementById('vk_groups').style.opacity = '1';  // Показываем
    };
    document.head.appendChild(script);
  }

  // Intersection Observer для активации при скролле
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          loadVKWidget();
          observer.unobserve(entry.target);
        }
      });
    });
    observer.observe(document.getElementById('vk_groups'));
  } else {
    // Fallback для старых браузеров: загружаем сразу
    loadVKWidget();
  }
</script>