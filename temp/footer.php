<!-- START FOOTER -->
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package makewp005
 */
$options = get_option('makewp005_theme_settings');

$copyright_text = get_option('theme_copyright_text');
$designed_by_text = get_option('theme_designed_by_text');
$copyright_color = get_option('theme_copyright_color');
$english_conversation_courses = get_option('theme_english_conversation_courses');
$cabinet_url = get_option('theme_cabinet_url');
$current_url = get_the_permalink();

                #if (valControl()[1]) {
                    #if(valControl()[1] == 1) {

                        if(!is_home()){
                            if($current_url == $english_conversation_courses){
                                /**
                                 * на странице лендинга
                                 */
                                $footer_color = get_option('theme_footer_color_lend');
                            }elseif($current_url == $cabinet_url){
                                /**
                                 * не странице кабинета
                                 */
                                $footer_color = get_option('theme_footer_color_lend');
                            }else{
                                /**
                                 * не на странице лендинга
                                 */
                                $footer_color = get_option('theme_footer_color_page');
                            }
                        }else{
                            /**
                             * не на странице лендинга
                             */
                            $footer_color = get_option('theme_footer_color_page');
                        }
                    #}
                #}else{
                    /**
                     * home
                     */

                #}
if(($current_url != $english_conversation_courses) || ($current_url != $cabinet_url) || ($current_url != get_home_url().'/')){
    $styleContent = 'style="padding: 0 10px;max-width: 1180px;"';
    echo '</div><!-- #contentWidth -->';
}
                ?>


</div><!-- #contentWrap -->

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
                <a href="https://tutor.reallanguage.club/index.php/main/rlogin">Я репетитор</a>
                <a href="https://tutor.reallanguage.club/index.php/main/slogin">Я ученик</a>
            </div>
        </div>
    </div>

</div>
</div>
<!-- END MODAL login-->

<script type="text/javascript" src="https://secure.skypeassets.com/i/scom/js/skype-uri.js"></script>
<footer id="footerWrap">
    <div class="widget-footer">


    </div>
    <div style="clear: both;"></div><!--//widget-footer -->
    <div class="row">
        <div class="col-sm-0 col-md-2 col-lg-2">
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2  col-lg-2">
            <a href="https://tutor.reallanguage.club/index.php/main/filter">Найти репетитора</a>
            <br><br>
            <a href="https://tutor.reallanguage.club/index.php/main/about">Как это работает</a>
            <br><br>
            <a href="https://reallanguage.club/o-nas/">О нас</a>
            <br><br>
            <a href="https://tutor.reallanguage.club/index.php/main/repetitorregistration">Работа для репетиторов</a>
        </div>
        <div class="col-sx-12 col-sm-3 col-md-2  col-lg-2">
            Репетиторы онлайн по Skype:<br>
            <a href="https://tutor.reallanguage.club/index.php/main/filter?lang=eng">Репетиторы по английскому</a><br>
            <a href="https://tutor.reallanguage.club/index.php/main/filter?lang=nem">Репетиторы по немецкому</a><br>
            <a href="https://tutor.reallanguage.club/index.php/main/filter?lang=rus">Репетиторы по русскому</a><br>
            <a href="https://tutor.reallanguage.club/index.php/main/filter?lang=fra">Репетиторы по французскому</a><br>
            <a href="https://tutor.reallanguage.club/index.php/main/filter?lang=ita">Репетиторы по итальянскому</a><br>
            <a href="https://tutor.reallanguage.club/index.php/main/filter?lang=isp">Репетиторы по испанскому</a>
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
            <br>
            Real Language Club<br>
            24B Rue René Cornelis<br>
            51200 Epernay, France<br>
            Отвечаем в мессенжерах:<br>
            <a href="https://www.messenger.com/t/adminRealLanguageClub"><img src="https://tutor.reallanguage.club/img/fb.png" alt="facebook"></a>
            <a href="skype:live:b79d2994b5024754">
                <div id="SkypeButton_Call_live:b79d2994b5024754_1">
                    <script type="text/javascript">
                        Skype.ui({
                            "name": "chat",
                            "element": "SkypeButton_Call_live:b79d2994b5024754_1",
                            "participants": ["live:b79d2994b5024754"],
                            "imageSize": 32
                        });
                    </script>
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
            <?php dynamic_sidebar('footer2'); ?>
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
    <div class="row f-end">
        <div class="col-sm-12 text-center">
            <?php dynamic_sidebar('footer3'); ?>
        </div>
    </div>
</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

<script src="/wp-content/themes/typal-makewp005/flipclock/js/flipclock.js"></script>

<script>
    jQuery(document).on('ready', function () {
        setTimeout(function () {
            var sliderBlock = jQuery('.content__slider');
            if (jQuery(window).height() >= (jQuery('.header').height()
                    + jQuery('.content').height()
                    + jQuery('.footer').height()
                    + sliderBlock.height()

                    ))
                jQuery('.content__slider').show();
        }, 300);

        jQuery('.mainmenu__menu-toggle').on('click', function () {
            jQuery('.mainmenu').toggleClass('mobile-invisible');
            return false;
        });
    });
</script>
<style>
	#__utl-buttons-1.utl-mobile  .uptl_container-share .uptl_toolbar li .sn-icon
	{
		font-size:30px !important;
	}
</style>
</body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.9";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php include_once("analyticstracking.php") ?>
</hthl>
