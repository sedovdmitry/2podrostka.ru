<script type="text/javascript">
  // Функция для показа fallback
  function showFallback() {
    const fallbackElement = document.getElementById('vk_wall_fallback');
    if (fallbackElement) {
      fallbackElement.style.display = 'block';
    }
  }

  // Функция для lazy-load виджета стены
  function loadVKWallWidget() {
    const widgetElement = document.getElementById('vk_wall');
    if (!widgetElement) {
      showFallback();
      return;
    }
    if (widgetElement.dataset.loaded) {
      return;
    }

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
          width: 262,
          height: 800,
          no_cover: 1,
          wide: 1,
          color1: "FFFFFF",
          color2: "000000",
          color3: "5181B8"
        }, 62738566);
        widgetElement.dataset.loaded = 'true';
        widgetElement.style.opacity = '1';
      } catch (e) {
        console.error('Ошибка инициализации виджета стены: ', e);
        showFallback();
      }
    };
    script.onerror = function() {
      console.error('Ошибка загрузки openapi.js');
      showFallback();
    };
    document.head.appendChild(script);
  }

  // Intersection Observer для загрузки при видимости
  if ('IntersectionObserver' in window) {
    const widgetElement = document.getElementById('vk_wall');
    if (!widgetElement) {
      console.error('Элемент vk_wall не найден для IntersectionObserver');
      showFallback();
    } else {
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            loadVKWallWidget();
            observer.unobserve(entry.target);
          }
        });
      }, { rootMargin: '200px' });
      observer.observe(widgetElement);
    }
  } else {
    // Fallback для старых браузеров
    console.log('IntersectionObserver недоступен, запуск loadVKWallWidget');
    loadVKWallWidget();
  }
</script>
