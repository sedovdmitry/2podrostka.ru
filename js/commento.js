document.addEventListener("DOMContentLoaded", function(event) {

  var waitForEl = function(selector, callback) {
      if ($(selector).length) {
          callback();
      } else {
          setTimeout(function() {
              waitForEl(selector, callback);
          }, 100);
      }
  };

  // перевод формы ввода комментария, который видит пользователь первым
  function translateCommento() {
      $('#commento-login .commento-login-text').text('Авторизоваться');
      $('#commento-textarea-root').attr('placeholder', 'Добавить комментарий');
      $('#commento-markdown-button-root').html('<b>M ↓</b> Форматировать текст');
      $('#commento-submit-button-root').text('Отправить');
      $('#commento-mod-tools-lock-button').text('Блокировка темы');
      $('.commento-anonymous-checkbox-container').find('label').text('Анонимный комментарий');
      $('#commento-sort-policy-score-desc').text('С высоким рейтингом');
      $('#commento-sort-policy-creationdate-desc').text('Самые новые');
      $('#commento-sort-policy-creationdate-asc').text('Самые старые');
  }

  waitForEl('#commento-submit-button-root', function() {
      translateCommento();
  });

  function translateAuthorizationPopup() {
      $('#commento-login-box-oauth-pretext').text('Авторизоваться');
      $('#commento-login-box-email-subtitle').text('Войти с вашим адресом электронной почты');
      $('#commento-login-box-email-button').text('Далее');
      $('#commento-login-box-forgot-link-container .commento-forgot-link').text('Забыли пароль?')
      $('#commento-login-box-login-link-container .commento-login-link').text('У вас нет аккаунта? Зарегистрируйтесь.');
  }

  var checkCommentoAuthShowed = setInterval(function() {
      var popup = $('#commento-login-box');
      if (popup.length && !popup.attr('data-translated')) {
          translateAuthorizationPopup();
          $(popup).attr('data-translated', 'true');
      }
  }, 100); // check every 100ms

  function translateMarkdownPopup(markdown) {
      $(markdown).find('td').each(function() {
          var replaceText = $(this).html()
              .replace('surround text with', 'оберните текст как здесь: ')
              .replace('or just a bare URL', 'или просто URL')
              .replace('prefix with', 'префикс со знаком "больше": ')
          $(this).html(replaceText)
      })
  }

  var checkCommentoMarkdown = setInterval(function() {
      var markdown = $('#commento').find('table[id^="commento-markdown-help-"]');
      if (markdown.length && !markdown.attr('data-translated')) {
          markdown.each(function() {
              if(!$(this).attr('data-translated')) {
                  translateMarkdownPopup(this);
                  $(this).attr('data-translated', 'true');
              }
          })
      }
  }, 100); // check every 100ms

  var checkReply = setInterval(function() {
      var replyButton = $('.commento-header button.commento-option-reply');
      if (replyButton.length) {
          $(replyButton).on('click', function() {
              waitForEl('#commento-comments-area textarea', function() {
                  $('#commento-comments-area').find('textarea').attr('placeholder', 'Добавить комментарий')
                  $('#commento-comments-area').find('label').text('Анонимный комментарий')
                  $('#commento-comments-area').find('button[id^="commento-submit-button-"]').text('Отправить')
              });                
          })
          clearInterval(checkReply);
      }
  }, 100); // check every 100ms
});