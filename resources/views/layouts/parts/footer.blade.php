{{-- Pie de página --}}

<footer class="main_footer">
    <div class="container">
        <div class="padT70 padB40">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="foot-sec">
                        <h3>Atención al cliente</h3>
                        <p>Red Tucushop
                            <br>Phone: +54 9 381 511-3710
                            <br>E-mail: info@tucushop.com
                        </p>
                        <p>
                            <a href="https://www.facebook.com/moda.tucushop/" target="_blank"><span><i class="fab fa-facebook" aria-hidden="true"></i></span></a>
                            <a href="https://www.instagram.com/moda.tucushop/" target="_blank"><span><i class="fab fa-instagram" aria-hidden="true"></i></span></a>
                            <a href="https://www.twitter.com/moda.tucushop/" target="_blank"><span><i class="fab fa-twitter" aria-hidden="true"></i></span></a>
                            <a href="https://www.pinterest.com/moda.tucushop/" target="_blank"><span><i class="fab fa-pinterest" aria-hidden="true"></i></span></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="foot-sec">
                        <h3>TU CUENTA </h3>
                        <ul class="pad0">
                            <? if(!isset($_SESSION['moda_user'])){ ?>
                                <li><a href="login/"><i class="fa fa-angle-right" aria-hidden="true"></i>Inicia sesión</a></li>
                                <li><a href="register/"><i class="fa fa-angle-right" aria-hidden="true"></i>Crea tu cuenta</a></li>
                            <? } else { ?>
                                <li><a href="user/"><i class="fa fa-angle-right" aria-hidden="true"></i>Mis datos personales</a></li>
                                <li><a href="store/"><i class="fa fa-angle-right" aria-hidden="true"></i>Administrar mis negocios</a></li>
                            <? } ?>
                            <li><a href="javascript:;" onclick="reportar()"><i class="fa fa-angle-right" aria-hidden="true"></i>Reportar un error en la página</a></li>
                            <li><a href="javascript:;" onclick="contactus()"><i class="fa fa-angle-right" aria-hidden="true"></i>Hacenos una consulta</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="foot-sec">
                        <h3>PARTICIPA </h3>
                        <ul class="pad0">
                            <li><a href="pages/vender-en-este-sitio_33/"><i class="fa fa-angle-right" aria-hidden="true"></i>Vender en este sitio</a></li>
                            <li><a href="help/"><i class="fa fa-angle-right" aria-hidden="true"></i>Centro de ayuda</a></li>
                            <li><a href="pages/politicas-de-privacidad_22/"><i class="fa fa-angle-right" aria-hidden="true"></i>Políticas de privacidad</a></li>
                            <li><a href="pages/terminos-y-condiciones-del-servicio_11/"><i class="fa fa-angle-right" aria-hidden="true"></i>Términos y condiciones de uso</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer padTB30 hide">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <p class="lh40">Copyright 2018 &copy; All Right Reserved - <a href="https://www.xtofactory.com/"><span>XTO Factory</span></a></p>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <figure>
                        <img src="assets/images/logo-xtofactory.png" alt=""/>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</footer>