$.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}

$( document ).ready(function() {
  $(['/img/kontrol/cat_5_over.png',
'/img/kontrol/cat_1_over.png',
'/img/kontrol/cat_2_over.png',
'/img/kontrol/cat_3_over.png',
'/img/kontrol/cat_4_over.png',
'/img/kontrol/condom_hover.png',
'/img/kontrol/diaphragm_hover.png',
'/img/kontrol/emergency_hover.png',
'/img/kontrol/female-condom_hover.png',
'/img/kontrol/implanon_hover.png',
'/img/kontrol/iud-s_hover.png',
'/img/kontrol/iud-p_hover.png',
'/img/kontrol/iud-m_hover.png',
'/img/kontrol/patch_hover.png',
'/img/kontrol/pill_hover.png',
'/img/kontrol/pull-out_hover.png',
'/img/kontrol/ring_hover.png',
'/img/kontrol/shot_hover.png',
'/img/kontrol/sponge_hover.png',
'/img/kontrol/waiting_hover.png']).preload();

  $(".bce_cat_group div").click(function( event ) {

    /* get category class */
    catClass = $(this).attr("class");

    /* remove active class from all category div */
    $(".bce_cat_group div").removeClass('active');

    /* destroy all existing tooltip upon clicking on category icon */
    $('.bce_method').qtip('destroy');

    /* reset the active methods upon click on the same category again */
    if (catClass.indexOf('active') != -1)
    {
       if (catClass.indexOf('bce_cat_5') != -1)
       {
          /* activate all methods for category 5 (eye icon) */
          $('.bce_method').removeClass('active').removeClass('blurred-method').addClass('normal');
       }
       else
       {
          /* Reset the blurred methods. Fade in for blurred images */
          if($.support.opacity)
          {
             $('.blurred-method [class^=bce_meth_]').fadeTo(800, 1, function(){
                //$('.bce_method').foggy(false).removeClass('active').removeClass('blurred-method').addClass('normal');
                $('.bce_method').removeClass('active').removeClass('blurred-method').addClass('normal');
            });
          }
          else
          {
             $('.blurred-method [class^=bce_meth_]').fadeTo(200, 1, function(){
                //$('.bce_method').foggy(false).removeClass('active').removeClass('blurred-method').addClass('normal');
                $('.blurred-method [class^=bce_meth_]').css("background-color", "");
                $('.bce_method').removeClass('active').removeClass('blurred-method').addClass('normal');
            });
          }
       }

      /* assign default header for the category */
      $(".bce_cat_header").html("Сортировать методы по...");

       return;
    }

    /* Fade in for blurred images */
    if($.support.opacity)
    {
       $('.blurred-method [class^=bce_meth_]').fadeTo(0 , 1);
    }
    else
    {
       $('.blurred-method [class^=bce_meth_]').fadeTo(0 , 1).css("background-color", "");
    }

    /* change category header depending on the clicked category */
    $(".bce_cat_header").html($(this).attr("title"));

    /* blur all the methods */
    /*
    $('.bce_method').removeClass('normal').removeClass('active').removeClass('blurred-method').addClass('blurred-method').foggy({
       blurRadius: 2,          // In pixels.
       opacity: 0.8,           // Falls back to a filter for IE.
       cssFilterSupport: true  // Use "-webkit-filter" where available.
   });*/

   $('.bce_method').removeClass('normal').removeClass('active').removeClass('blurred-method').addClass('blurred-method');

    /* active the selected category related methods only */
   categoryClass = 'div.' + this.className;
   //$(categoryClass).foggy(false).removeClass('active').removeClass('blurred-method').addClass('active');
   $(categoryClass).removeClass('active').removeClass('blurred-method').addClass('active');

   /* Fade out for blurred images */
   if($.support.opacity)
    {
       $('.blurred-method [class^=bce_meth_]').fadeTo(800, 0.2);
    }
    else
    {
       $('.blurred-method [class^=bce_meth_]').fadeTo(200, 0.2).css("background-color", "#FFFFFF");
    }
  });

  /* Tooltip area */
  $.fn.qtip.defaults.content.title.button = true;
  $.fn.qtip.defaults.show.event = 'click';
  $.fn.qtip.defaults.show.solo = true;
  $.fn.qtip.defaults.show.ready = true;
  $.fn.qtip.defaults.hide.event = 'click';
  $.fn.qtip.defaults.style.classes = '';
  $.fn.qtip.defaults.style.tip.corner = true;
  $.fn.qtip.defaults.style.tip.border = true;
  $.fn.qtip.defaults.style.tip.width = 20;
  $.fn.qtip.defaults.style.tip.height = 25;

  //*
  $('.bce_meth_waiting_tooltip').click(function (event) {

     allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_waiting_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Выбери не заниматься сексом (пока не выйдешь замуж/женишься, не будешь готов(а)... что угодно). Это единственный эффективный на 100% способ контроля рождаемости и защиты от венерических заболеваний.</div><div class="learn-more-text"></div>',
          title: {
                text: 'Подожди'
             }
        },
        position: {
          adjust: {
            x: -50,
            y: -100
          }
        }
      });
  });

  $('.bce_meth_fc_tooltip').click(function (event) {

     allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_fc_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Подобно вывернутому мужскому презервативу этот мешочек помещается во влагалище; сперма попадает в презерватив, а не в тело девушки.</div><div class="learn-more-text"></div>',
          title: {
                text: 'Женский презерватив'
             }
        },
        position: {
           my: 'left top',
          adjust: {
            x: -75,
            y: -100
          }
        }
      });
  });

  $('.bce_meth_iud_skyla_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_iud_skyla_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Гормональная внутриматочная спираль. Эффективна в течении трех лет. Подходит для женщин не имеющих детей.</div><div class="learn-more-text"></div>',
          title: {
                text: 'Skyla'
             }
        },
        position: {
           my: 'top left',
          adjust: {
            x: -25,
            y: -10
          }
        }
      });
  });

  $('.bce_meth_iud_paragard_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_iud_paragard_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Медьсодержащая внутриматочная спираль. Негормональная ВМС, эффективна в течение 12 лет.</div><div class="learn-more-text"></div>',
          title: {
                text: 'ParaGard'
             }
        },
        position: {
           my: 'top left',
          adjust: {
            x: -40,
            y: -20
          }
        }
      });
  });

  $('.bce_meth_iud_mirena_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_iud_mirena_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Гормональная внутриматочная спираль. Выделяет гормон, не позволяющий добраться сперматозоидам до шейки матки. Эффективна в течение пяти лет.</div><div class="learn-more-text"></div>',
          title: {
                text: 'Mirena'
             }
        },
        position: {
           my: 'top left',
          adjust: {
            x: -30,
            y: -20
          }
        }
      });
  });

  $('.bce_meth_ring_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_ring_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Небольшое гибкое кольцо, которое глубоко вводится во влагалище на три недели. Противозачаточный эффект наступает через неделю и длится спустя неделю после извлечения из влагалища.</div></div>',
          title: {
                text: 'НоваРинг'
             }
        },
        position: {
           my: 'top left',
          adjust: {
            x: -50,
            y: -10
          }
        }
      });
  });

  $('.bce_meth_patch_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_patch_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Контрацептивный гормональный пластырь. Пластырь наклеивается 1 раз на 7 дней и обеспечивает надежный эффект при минимуме усилий. Степень надежности - 99,4%.</div></div>',
          title: {
                text: 'Патч-пластырь'
             }
        },
        position: {
           my: 'top left',
          adjust: {
            x: -5,
            y: -5
          }
        }
      });
  });

  $('.bce_meth_diaphragm_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_diaphragm_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Влагалищная диафрагма - небольшая латексная чашечка при введении во влагалище закрывает матку от сперматозоидов. Эффективность - 80-85%.</div><div class="learn-more-text"></div>',
          title: {
                text: 'Мембрана'
             }
        },
        position: {
           my: 'left top',
          adjust: {
            x: -30,
            y: -170
          }
        }
      });
  });

  $('.bce_meth_implanon_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_implanon_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Небольшой стержень размером со спичку, вводится под кожу девушке (например, в руку). Выделяет гормон прогестерон. Эффективен в течение трех лет. Эффективность 99%.</div><div class="learn-more-text"></div>',
          title: {
                text: 'Имплантат'
             }
        },
        position: {
           my: 'left top',
          adjust: {
            x: -10,
            y: -50
          }
        }
      });
  });

  $('.bce_meth_shot_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_shot_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Гормональная инъекция делается раз в три месяца женщине. Как любой укол болезнен. В отличие от таблеток, хватает намного дольше.</div></div>',
          title: {
                text: 'Инъекция'
             }
        },
        position: {
           my: 'top right',
          adjust: {
            x: -100,
            y: -50
          }
        }
      });
  });

  $('.bce_meth_condom_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_condom_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Охватывает пенис парня, сперма идет в презерватив, а не в тело девушки.</div></div>',
          title: {
                text: 'Мужской презерватив'
             }
        },
        position: {
           my: 'top center',
          adjust: {
            x: -50,
            y: -5
          }
        }
      });
  });

  $('.bce_meth_pill_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_pill_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Таблетки девушка принимает каждый день примерно в одно и то же время. Есть много различных вариантов.</div></div>',
          title: {
                text: 'Таблетки'
             }
        },
        position: {
           my: 'right top',
          adjust: {
            x: -210,
            y: -10
          }
        }
      });
  });

  $('.bce_meth_sponge_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_sponge_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Губка контрацептивная - небольшой круглый кусок пены, предотвращает проникновению сперматозоидов к матке. Эффективность: 75-86%.</div><div class="learn-more-text"></div>',
          title: {
                text: 'Губка'
             }
        },
        position: {
           my: 'top left',
          adjust: {
            x: -80,
            y: -30
          }
        }
      });
  });

  $('.bce_meth_emergency_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_emergency_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">В экстренном случае после незащищенного вагинального секса можно принять таблетку, которая прервет беременность. Принять нужно как можно скорее до 1-3 суток после секса. Это резервный метод, его нельзя использовать регулярно.</div><div class="learn-more-text"></div>',
          title: {
                text: 'Экстренная контрацепция'
             }
        },
        position: {
           my: 'bottom center',
          adjust: {
            x: -70,
            y: -130
          }
        }
      });
  });

  $('.bce_meth_pull-out_tooltip').click(function (event) {

   allClasses = $(this).attr("class");

     if (allClasses.indexOf('blurred-method') != -1)
     {
        /* do nothing */
        return;
     }

     $('.bce_meth_pull-out_tooltip').removeData('qtip').qtip({
        content: {
          text: '<div class="tooltip-content">Парень вынимает член до того, как он эякулирует; этим методом пользоваться сложнее, чем вы думаете. Низкоэффективный метод контрацепции.</div></div>',
          title: {
                text: 'Прерванный'
             }
        },
        position: {
           my: 'right bottom',
          adjust: {
            x: -200,
            y: -160
          }
        }
      });
  });
  //*/

});