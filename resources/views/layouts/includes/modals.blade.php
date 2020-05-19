    {{-- Reporte de errores en la página --------------------------------- --}}

    <div class="pop-bg"></div>
	<div class="pop-container none" id="m-report">
		<div class="pop-box">
            <div class="pop-head">{{ config('app.name', 'Laravel') }}</div>
			<a href="javascript:;" class="pop-close pop-btn-close" onclick="pop_close()"><i class="fa fa-times"></i></a>
			<div class="pop-html">
                <div id="modal-reporting">
        
                    <div class="padB30">
            
                        <div class="marB30">
                            <h3>Reportar un error</h3>
                        </div>

                        <div class="form-report">

                            <form id="send-report" action="{{ route('feedback.bugs') }}" method="POST">
                                
                                @csrf

                                <input type="hidden" name="url" value="{{ url()->current() }}" />
                        
                                <div class="form-group row">
                                    <label for="report-name" class="col-md-3 col-form-label text-md-right">{{ __('Nombre') }}</label>
                                    <div class="col-md-8">
                                        <input type="text" name="name" class="form-control" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="report-whereis" class="col-md-3 col-form-label text-md-right">{{ __('Dónde está el error?') }}</label>
                                    <div class="col-md-8">
                                        <select name="whereis" class="form-control">
                                            <option value="This">En la página actual</option>
                                            <option value="All">En todo el sitio</option>
                                            <option value="Custom">Prefiero describirlo con mis palabras</option>
                                        </select>
                                    </div>
                                </div>
                    
                                <div class="form-group row">
                                    <label for="report-content" class="col-md-3 col-form-label text-md-right">{{ __('Describe el error que quieres reportar') }}</label>
                                    <div class="col-md-8">
                                        <textarea name="content" rows="4" class="form-control" required autocomplete="off"></textarea>
                                    </div>
                                </div>
                    
                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label text-md-right">&nbsp;</label>
                                    <div class="col-md-8 a-left">
                                        <button type="submit" class="btn btn-primary" id="send-report-submit">Enviar reporte</button>
                                        <button type="button" class="btn btn-link" onclick="pop_close();">Cancelar</button>
                                    </div>
                                </div>

                            </form>

                        </div>

                        <div class="resp-report none">
                            <div class="f18 alert alert-success padT25">
                                <p>Tu reporte fue enviado exitosamente.<br>Buscaremos solucionar el inconveniente lo más pronto posible.</p>
                                <p class="b">¡Muchas gracias por tu ayuda!</p>
                            </div>
                            <p class="marT20"><button type="button" class="btn btn-primary w25 refresh">¡Entendido!</button></p>
                        </div>
            
                    </div>
            
                </div>

            </div>

		</div>
    </div>
    

<div class="none">

    {{-- Consultas sobre la página --------------------------------------- --}}

    <div id="modal-question">
        
        <div class="padB30">

            <div class="marB30">
                <h3>Hacer una consulta</h3>
            </div>
            
            <div class="form-group row">
                <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nombre') }}</label>

                <div class="col-md-8">
                    <input type="text" id="name" name="name" class="form-control" required autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="cellphone" class="col-md-3 col-form-label text-md-right">{{ __('cellphone') }}</label>

                <div class="col-md-8">
                    <input type="text" id="cellphone" name="cellphone" class="form-control" required autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="report" class="col-md-3 col-form-label text-md-right">{{ __('Consulta') }}</label>

                <div class="col-md-8">
                    <textarea id="report" name="report" rows="4" class="form-control" required autocomplete="off"></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label for="lastname" class="col-md-3 col-form-label text-md-right">&nbsp;</label>

                <div class="col-md-8 a-right">
                    <button type="button" class="btn btn-light" onclick="pop_close();">Cancelar</button>
                    <button type="button" class="btn btn-primary">Enviar consulta</button>
                </div>
            </div>

        </div>

    </div>

</div>