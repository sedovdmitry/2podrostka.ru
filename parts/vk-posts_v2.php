<div id="vk_wall" style="opacity: 0; transition: opacity 0.3s;"></div>
<script type="text/javascript">
  // Функция для lazy-load виджета стены
  function loadVKWallWidget() {
    if (document.getElementById('vk_wall').dataset.loaded) return; // Уже загружено

    // Асинхронная загрузка openapi.js напрямую
    const script = document.createElement('script');
    script.src = 'https://vk.com/js/api/openapi.js?169';
    script.async = true;
    script.onload = function() {
      try {
        VK.init({
          apiId: 4040691,
          onlyWidgets: true
        });
        VK.Widgets.Group("vk_wall", {
          mode: 4, // Режим стены (новости)
          width: 262, // Как в vk_groups
          height: 400, // Ограниченная высота
          no_cover: 1, // Без обложки
          wide: 1, // Кнопка "Мне нравится"
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
      console.error('Ошибка загрузки openapi.js');
      document.getElementById('vk_wall').innerHTML = 
        'Не удалось загрузить скрипт. Посетите наше сообщество: <a href="https://vk.com/polovoevospitanie?from=2podrostka.ru">ВКонтакте</a>';
    };
    document.head.appendChild(script);
  }

  // Intersection Observer для загрузки при видимости
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
    // Fallback для старых браузеров
    loadVKWallWidget();
  }
</script>
<!-- Fallback для Safari/Firefox -->
<div id="vk_wall_fallback" style="display: none;">Посетите наше сообщество: <a href="https://vk.com/polovoevospitanie?from=2podrostka.ru">ВКонтакте</a></div>
<script>
  if (navigator.userAgent.includes('Safari') || navigator.userAgent.includes('Firefox')) {
    document.getElementById('vk_wall').style.display = 'none';
    document.getElementById('vk_wall_fallback').style.display = 'block';
  }
</script>
