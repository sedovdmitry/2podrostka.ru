<div id="vk_community_messages" style="opacity: 0; transition: opacity 0.3s;"></div>
<script type="text/javascript">
  // Функция для lazy-load виджета
  function loadVKMessagesWidget() {
    if (document.getElementById('vk_community_messages').dataset.loaded) return; // Уже загружено

    // Асинхронная загрузка openapi.js
    const script = document.createElement('script');
    script.src = 'https://vk.com/js/api/openapi.js?169';
    script.async = true;
    script.onload = function() {
      // Инициализация Open API
      VK.init({
        apiId: 4040691, // Ваш apiId из предыдущего примера
        onlyWidgets: true
      });
      // Инициализация виджета сообщений с оптимизированными параметрами
      VK.Widgets.CommunityMessages("vk_community_messages", 62738566, {
        welcomeScreen: 0, // Отключаем экран приветствия
        expanded: 0, // Не раскрывать сразу
        disableNewMessagesSound: 1, // Отключить звук новых сообщений
        disableExpandChatSound: 1, // Отключить звук раскрытия
        disableButtonTooltip: 1, // Отключить всплывающую подсказку
        widgetPosition: 'right', // Правое положение (по умолчанию)
        buttonType: 'blue_circle', // Стандартная кнопка
        onCanNotWrite: function(reason) {
          console.log('Ошибка виджета сообщений: ', reason);
          // Можно показать пользователю уведомление, например, через alert
        }
      });
      document.getElementById('vk_community_messages').dataset.loaded = 'true';
      document.getElementById('vk_community_messages').style.opacity = '1';
    };
    document.head.appendChild(script);
  }

  // Intersection Observer для загрузки при видимости
  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          loadVKMessagesWidget();
          observer.unobserve(entry.target);
        }
      });
    }, { rootMargin: '200px' }); // Загружаем за 200px до видимости
    observer.observe(document.getElementById('vk_community_messages'));
  } else {
    // Fallback для старых браузеров
    loadVKMessagesWidget();
  }
</script>
