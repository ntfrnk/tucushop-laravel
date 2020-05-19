<div class="pop-bg"></div>
    
{{-- Reporte de errores en la página --------------------------------- --}}

<div class="pop-container" id="m-report">
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
                                <div class="col-md-7 a-le8t">
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
                        <p class="marT20"><button type="button" class="btn btn-primary w25 refresh">Cerrar esta ventana</button></p>
                    </div>
        
                </div>
        
            </div>

        </div>

    </div>
</div>


{{-- Consultas sobre la página --------------------------------------- --}}

<div class="pop-container" id="m-question">
    <div class="pop-box">
        <div class="pop-head">{{ config('app.name', 'Laravel') }}</div>
        <a href="javascript:;" class="pop-close pop-btn-close" onclick="pop_close()"><i class="fa fa-times"></i></a>
        <div class="pop-html">
            <div id="modal-reporting">
    
                <div class="padB30">
        
                    <div class="marB30">
                        <h3>Hacer una consulta</h3>
                    </div>

                    <div class="form-question">

                        <form id="send-question" action="{{ route('feedback.question') }}" method="POST">
                            
                            @csrf
                    
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Nombre') }}</label>
                                <div class="col-md-8">
                                    <input type="text" name="name" class="form-control" required autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Tu correo o celular') }}</label>
                                <div class="col-md-8">
                                    <input type="text" name="contact" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Escribe tu consulta') }}</label>
                                <div class="col-md-8">
                                    <textarea name="content" rows="4" class="form-control" required autocomplete="off"></textarea>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label text-md-right">&nbsp;</label>
                                <div class="col-md-7 a-center">
                                    <button type="submit" class="btn btn-primary">Enviar consulta</button>
                                    <button type="button" class="btn btn-link" onclick="pop_close();">Cancelar</button>
                                </div>
                            </div>

                        </form>

                    </div>

                    <div class="resp-question none">
                        <div class="f18 alert alert-success padT25">
                            <p>Tu consulta fue enviada exitosamente.<br>En breve nos pondremos en contacto con vos para responderte.</p>
                            <p class="b">¡Muchas gracias por contactarnos!</p>
                        </div>
                        <p class="marT20"><button type="button" class="btn btn-primary w25 refresh">Cerrar esta ventana</button></p>
                    </div>
        
                </div>
        
            </div>

        </div>

    </div>
</div>


{{-- Informar un problema con un producto ---------------------------- --}}

<div class="pop-container" id="m-problem">
    <div class="pop-box">
        <div class="pop-head">{{ config('app.name', 'Laravel') }}</div>
        <a href="javascript:;" class="pop-close pop-btn-close" onclick="pop_close()"><i class="fa fa-times"></i></a>
        <div class="pop-html">
            <div id="modal-problem">
    
                <div class="padB30">
        
                    <div class="marB30">
                        <h3>Informar un problema con este artículo</h3>
                    </div>

                    <div class="form-problem">

                        <form id="send-problem" action="{{ route('feedback.problem') }}" method="POST">
                            
                            @csrf

                            <input type="hidden" name="item_id" value="{{ $item->id }}">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Cuál es el problema?') }}</label>
                                <div class="col-md-8">
                                    <select name="reason" class="form-control">
                                        <option value="Info engañosa">La información publicada es engañosa</option>
                                        <option value="Precio falso">El precio del artículo no es real</option>
                                        <option value="Fotos falsas">Las fotos no pertenecen al artículo publicado</option>
                                        <option value="Sin stock">El artículo está publicado pero no hay stock</option>
                                        <option value="Otro">Otro problema (decribir el detalle más abajo)</option>
                                    </select>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label text-md-right">{{ __('Escribe los detalles del problema que encontraste') }}</label>
                                <div class="col-md-8">
                                    <textarea name="content" rows="4" class="form-control" required autocomplete="off"></textarea>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label text-md-right">&nbsp;</label>
                                <div class="col-md-7 a-center">
                                    <button type="submit" class="btn btn-primary">Enviar consulta</button>
                                    <button type="button" class="btn btn-link" onclick="pop_close();">Cancelar</button>
                                </div>
                            </div>

                        </form>

                    </div>

                    <div class="resp-problem none">
                        <div class="f18 alert alert-success padT25">
                            <p>El problema fue reportado exitosamente.<br>Vamos a tomar cartas en el asunto para evitar que estas cosas ocurran.</p>
                            <p class="b">¡Muchas gracias por ayudarnos a mejorar!</p>
                        </div>
                        <p class="marT20"><button type="button" class="btn btn-primary w25 refresh">Cerrar esta ventana</button></p>
                    </div>
        
                </div>
        
            </div>

        </div>

    </div>
</div>