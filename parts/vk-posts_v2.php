<script type="text/javascript">
  // Функция для lazy-load виджета стены
  function loadVKWallWidget() {
    if (document.getElementById('vk_wall').dataset.loaded) return; // Уже загружено

    // Асинхронная загрузка openapi.js через Nginx кэш
    const script = document.createElement('script');
    script.src = '/vk/openapi.js';
    script.async = true;
    script.onload = function() {
      try {
        VK.init({
          apiId: 4040691,
          onlyWidgets: true
        });
        VK.Widgets.Group("vk_wall", {
          mode: 4,
          width: 262,
          height: 400,
          no_cover: 1,
          wide: 1,
          color1: "FFFFFF",
          color2: "000000",
          color3: "5181B8"
        }, 62738566);
        document.getElementById('vk_wall').dataset.loaded = 'true';
        document.getElementById('vk_wall').style.opacity = '1';
      } catch (e) {
        console.error('Ошибка инициализации виджета стены: ', e);
        document.getElementById('vk_wall').innerHTML = 
          'Ошибка загрузки виджета. Посетите наше сообщество: <a href="https://vk.com/polovoevospitanie?from=2podrostka.ru">ВКонтакте</a>';
      }
    };
    script.onerror = function() {
      console.error('Ошибка загрузки /vk/openapi.js');
      document.getElementById('vk_wall').innerHTML = 
        'Не удалось загрузить скрипт. Посетите наше сообщество: <a href="https://vk.com/polovoevospitanie?from=2podrostka.ru">ВКонтакте</a>';
    };
    document.head.appendChild(script);
  }

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          loadVKWallWidget();
          observer.unobserve(entry.target);
        }
      });
    }, { rootMargin: '200px' });
    observer.observe(document.getElementById('vk_wall'));
  } else {
    loadVKWallWidget();
  }
</script>