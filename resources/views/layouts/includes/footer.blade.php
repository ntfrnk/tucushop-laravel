{{-- Pie de página --}}

<footer class="main_footer">
    <div class="container">
        <div class="padT70 padB40">
            <div class="row margin-footer">
                <div class="col-md-4 col-sm-6 col-xs-12 marB20 order-md-1 order-3">
                    <div class="foot-sec">
                        <h3>Atención al cliente</h3>
                        <p>Red Tucushop
                            <br>WhatsApp: +54 9 381 320-0054
                            <br>E-mail: info@tucushop.com
                        </p>
                        <p>
                            <a href="https://www.facebook.com/moda.tucushop/" target="_blank"><span><i class="fab fa-facebook"></i></span></a>
                            <a href="https://www.instagram.com/moda.tucushop/" target="_blank"><span><i class="fab fa-instagram"></i></span></a>
                            <a href="https://www.twitter.com/moda.tucushop/" target="_blank"><span><i class="fab fa-twitter"></i></span></a>
                            <a href="https://www.pinterest.com/moda.tucushop/" target="_blank"><span><i class="fab fa-pinterest"></i></span></a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 marB20">
                    <div class="foot-sec">
                        <h3>TU CUENTA </h3>
                        <ul class="pad0">
                            @guest
                                <li><a href="{{ route('login') }}"><i class="fa fa-angle-right"></i>Inicia sesión</a></li>
                                <li><a href="{{ route('register') }}"><i class="fa fa-angle-right"></i>Crea tu cuenta</a></li>
                            @else
                                <li><a href="{{ route('user.home') }}"><i class="fa fa-angle-right"></i>Mis datos personales</a></li>
                                <li><a href="{{ route('store.list') }}"><i class="fa fa-angle-right"></i>Administrar mis negocios</a></li>
                            @endguest
                            <li><a href="javascript:;" class="reporting"><i class="fa fa-angle-right"></i>Reportar un error en la página</a></li>
                            <li><a href="javascript:;" id="question"><i class="fa fa-angle-right"></i>Hacenos una consulta</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 marB20">
                    <div class="foot-sec">
                        <h3>PARTICIPA </h3>
                        <ul class="pad0">
                            <li><a href="pages/vender-en-este-sitio_33/"><i class="fa fa-angle-right"></i>Vender en este sitio</a></li>
                            <li><a href="help/"><i class="fa fa-angle-right"></i>Centro de ayuda</a></li>
                            <li><a href="{{ route('page.policy') }}"><i class="fa fa-angle-right"></i>Políticas de privacidad</a></li>
                            <li><a href="{{ route('page.terms') }}"><i class="fa fa-angle-right"></i>Términos y condiciones de uso</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="bottom-footer padTB30 hide">
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
    </div> --}}
</footer>