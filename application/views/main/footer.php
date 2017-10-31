<!-- Modal login-->
    <div id="modal_login" class="modal fade add-hotel" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
        <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4>Выберите ваш личный кабинет</h4>
                    <a href="<?php echo base_url(); ?>index.php/main/rlogin">Я репетитор</a>
                    <a href="<?php echo base_url(); ?>index.php/main/slogin">Я ученик</a>
                </div>
          </div>
        </div>

      </div>
    </div>
<!-- END MODAL login-->
<script type="text/javascript" src="https://secure.skypeassets.com/i/scom/js/skype-uri.js"></script>
<footer>
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.10&appId=270094073449025";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <div class="row">
        <div class="col-sm-0 col-md-2 col-lg-2">
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2  col-lg-2">
            <a href="<?php  echo base_url(); ?>index.php/main/filter">Найти репетитора</a>
            <br><br>
            <a href="<?php  echo base_url(); ?>index.php/main/about">Как это работает</a>
            <br><br>
            <a href="https://reallanguage.club/o-nas/">О нас</a>
            <br><br>
            <a href="<?php  echo base_url(); ?>index.php/main/repetitorregistration">Работа для репетиторов</a>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2  col-lg-2">
            Репетиторы онлайн по Skype:<br>
            <a href="<?php echo base_url(); ?>index.php/main/filter?lang=eng">Репетиторы по английскому</a><br>
            <a href="<?php echo base_url(); ?>index.php/main/filter?lang=nem">Репетиторы по немецкому</a><br>
            <a href="<?php echo base_url(); ?>index.php/main/filter?lang=rus">Репетиторы по русскому</a><br>
            <a href="<?php echo base_url(); ?>index.php/main/filter?lang=fra">Репетиторы по французскому</a><br>
            <a href="<?php echo base_url(); ?>index.php/main/filter?lang=ita">Репетиторы по итальянскому</a><br>
            <a href="<?php echo base_url(); ?>index.php/main/filter?lang=isp">Репетиторы по испанскому</a>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2 col-lg-2">
            Мы в Facebook:<br>
            <a href="https://www.facebook.com/reallanguage.club">Разговорный английский</a><br>
            <a href="https://www.facebook.com/reallanguage.de/">Разговорный немецкий</a><br>
            <a href="https://www.facebook.com/reallanguage.ru/">Разговорный русский</a><br>
            <a href="https://www.facebook.com/reallanguage.fr">Разговорный французский</a><br>
            <a href="https://www.facebook.com/reallanguage.it/">Разговорный итальянский</a><br>
            <a href="https://www.facebook.com/reallanguage.es/">Разговорный испанский</a>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2  col-lg-2 mess">
            <a href="https://reallanguage.club/voprosy-i-otvety-po-rabote-s-platformoj-repetitory-real-language-club/">Вопросы и ответы</a>
            <br><br>
            <a href="https://reallanguage.club/kontakt/">Контакты</a>
            <br><br>
            Отвечаем в мессенжерах:<br>
            <a href="https://www.messenger.com/t/adminRealLanguageClub"><img src="<?php  echo base_url(); ?>img/fb.png" alt="facebook"></a>
            <a href="skype:live:b79d2994b5024754">
            <div id="SkypeButton_Call_live:b79d2994b5024754_1">
             <script type="text/javascript">
             Skype.ui({
             "name": "chat",
             "element": "SkypeButton_Call_live:b79d2994b5024754_1",
             "participants": ["live:b79d2994b5024754"],
             "imageSize": 32
         }); </script>
            </div>
            </a>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2  col-lg-2">
        </div>
    </div>
    <div class="row">
        <div class="col-sm-0 col-md-2 col-lg-2">
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2 col-lg-2 big">
            <a href="https://reallanguage.club/anglijskij-yazyk/">Английский язык</a><br>
            <a href="https://reallanguage.club/nemeckij/">Немецкий язык</a><br>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2  col-lg-2 big">
            <a href="https://reallanguage.club/russkij-yazyk/">Русский язык</a><br>
            <a href="https://reallanguage.club/francuski-yazik/">Французский язык</a><br>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2  col-lg-2 big">
            <a href="https://reallanguage.club/italyanskij-yazyk/">Итальянский язык</a><br>
            <a href="https://reallanguage.club/ispanskij/">Испанский язык</a><br>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2  col-lg-2 text-center social">
            Если вам понравилось, поделитесь с друзьями<br>
            <a onclick="Share.vkontakte('https://tutor.reallanguage.club','ReallanguageClub','https://tutor.reallanguage.club/img/main_logo.png','https://tutor.reallanguage.club')">
                <img src="<?php  echo base_url(); ?>img/vk.png" alt="vk">
            </a>
                <a onclick="Share.facebook('https://tutor.reallanguage.club','ReallanguageClub','https://tutor.reallanguage.club/img/main_logo.png','https://tutor.reallanguage.club')">
                    <img src="<?php  echo base_url(); ?>img/fb_.png" alt="facebook">
                </a>
            <a onclick="Share.odnoklassniki('https://tutor.reallanguage.club','https://tutor.reallanguage.club')">
                <img src="<?php  echo base_url(); ?>img/ok.png" alt="ok">
            </a>
            <a onclick="Share.mailru('https://tutor.reallanguage.club','ReallanguageClub','https://tutor.reallanguage.club/img/main_logo.png','https://tutor.reallanguage.club')">
                <img src="<?php  echo base_url(); ?>img/mm.png" alt="my world">
            </a>
            <a onclick="Share.google('https://tutor.reallanguage.club')">
                <img src="<?php  echo base_url(); ?>img/gp.png" alt="g+">
            </a>
            <a onclick="Share.twitter('https://tutor.reallanguage.club','ReallanguageClub')">
                <img src="<?php  echo base_url(); ?>img/tw.png" alt="twiter">
            </a>
            <a onclick="Share.livej('ReallanguageClub','https://tutor.reallanguage.club','иностранный язык,обучение,репетиторы')">
                <img src="<?php  echo base_url(); ?>img/lj.png" alt="life journal">
            </a>
        </div>
        <div class="col-sm-0 col-md-2 col-lg-2">

        </div>
    </div>
    <div class="row">
        <div class="col-sm-0 col-md-2 col-lg-2">
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2 col-lg-2 small">
            <a href="https://reallanguage.club/pravila-polzovaniya-sajtom/">Правила пользования сайтом</a>
            <span class="pull-right">|</span>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2 col-lg-2 small">
            <a href="https://reallanguage.club/texnicheskie-trebovaniya/">Технические требования</a>
            <span class="pull-right">|</span>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2 col-lg-2 small">
            <a href="https://reallanguage.club/polzovatelskoe-soglashenie/">Пользовательское соглашение</a>
            <span class="pull-right">|</span>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2 col-lg-2 small">
            <a href="https://reallanguage.club/politika-konfidencialnosti/">Политика конфиденциальности</a>
        </div>
        <div class="col-sm-0 col-md-2 col-lg-2">
        </div>
    </div>
    <script>
    Share = {
vkontakte: function(purl, ptitle, pimg, text) {
    url  = 'http://vk.com/share.php?';
    url += 'url='          + encodeURIComponent(purl);
    url += '&title='       + encodeURIComponent(ptitle);
    url += '&description=' + encodeURIComponent(text);
    url += '&image='       + encodeURIComponent(pimg);
    url += '&noparse=true';
    Share.popup(url);
},
odnoklassniki: function(purl, text) {
    url  = 'http://www.ok.ru/dk?st.cmd=addShare&st.s=1';
    url += '&st.comments=' + encodeURIComponent(text);
    url += '&st._surl='    + encodeURIComponent(purl);
    Share.popup(url);
},
facebook: function(purl, ptitle, pimg, text) {
    url  = 'http://www.facebook.com/sharer.php?s=100';
    url += '&p[title]='     + encodeURIComponent(ptitle);
    url += '&p[summary]='   + encodeURIComponent(text);
    url += '&p[url]='       + encodeURIComponent(purl);
    url += '&p[images][0]=' + encodeURIComponent(pimg);
    Share.popup(url);
},
twitter: function(purl, ptitle) {
    url  = 'http://twitter.com/share?';
    url += 'text='      + encodeURIComponent(ptitle);
    url += '&url='      + encodeURIComponent(purl);
    url += '&counturl=' + encodeURIComponent(purl);
    Share.popup(url);
},
google: function(purl) {
    url  = 'https://plus.google.com/share?';
    url += 'url='          + encodeURIComponent(purl);
    Share.popup(url);
},
mailru: function(purl, ptitle, pimg, text) {
    url  = 'http://connect.mail.ru/share?';
    url += 'url='          + encodeURIComponent(purl);
    url += '&title='       + encodeURIComponent(ptitle);
    url += '&description=' + encodeURIComponent(text);
    url += '&imageurl='    + encodeURIComponent(pimg);
    Share.popup(url)
},
livej: function(subject, levent, tags) {
    url  = 'http://www.livejournal.com/update.bml?';
    url += 'subject='          + encodeURIComponent(subject);
    url += '&event='       + encodeURIComponent(levent);
    url += '&prop_taglist=' + encodeURIComponent(tags);
    Share.popup(url)
},

popup: function(url) {
    window.open(url,'','toolbar=0,status=0,width=626,height=436');
}
};
    </script>


    <div class="row f-end">
        <div class="col-sm-12 text-center">
            © 2014-2017 Real Language Club
        </div>
    </div>
    <!-- Your share button code -->
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter46283391 = new Ya.Metrika({
                        id:46283391,
                        clickmap:true,
                        trackLinks:true,
                        accurateTrackBounce:true,
                        webvisor:true
                    });
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = "https://mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/46283391" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

</footer>
</body>
</html>
