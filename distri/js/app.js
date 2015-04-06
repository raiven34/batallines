(function($) {

	"use strict";
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 
        var today = yyyy+'-'+mm+'-'+dd;
        
	var options = {
                events_source: '/distri/CALENDARIO/events.json_1.php',
		view: 'month',
		tmpl_path: '/distri/CALENDARIO/tmpls/',
		tmpl_cache: false,
		day: today,
		onAfterEventsLoad: function(events) {
			if(!events) {
				return;
			}
			var list = $('#eventlist');
			list.html('');

			$.each(events, function(key, val) {
				$(document.createElement('li'))
					.html('<a class="col-xs-11 col-lg-11 col-md-11 col-sm-11" href="' + val.url + '">' + val.title + '</a><a class="col-xs-1 col-lg-1 col-md-1 col-sm-1"><span id="' + val.id + '" class="glyphicon glyphicon-remove-circle pull-right"></span></a>')
					.appendTo(list);
			});
                        
                        $('.glyphicon-remove-circle').click(function(){
                            var id = $(this).attr('id');

                            $.ajax({
                                    data: {"id": id},
                                    //Cambiar a type: POST si necesario
                                    type: "POST",
                                    dataType: "json",
                                    url: "../CALENDARIO/events_json_baja.php",
                                })
                                 .done(function( data, textStatus, jqXHR ) {
                                     if ( data.success ) {
                                         console.log( "La solicitud se ha completado correctamente." );
                                         $('#resultado').attr("class","col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center label-success");
                                         $('#resultado').html('Eliminado correctamente.');
                                     }else{
                                         console.log( "La solicitud ha fallado." );
                                         $('#resultado').attr("class","col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center label-danger");
                                         $('#resultado').html('Se ha producido un error de BBDD.');
                                     }
                                 })
                                 .fail(function( jqXHR, textStatus, errorThrown ) {
                                     if ( console && console.log ) {
                                         console.log( "La solicitud ha fallado: " +  textStatus);
                                         $('#resultado').attr("class","col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center label-danger");
                                         $('#resultado').html('Se ha producido un error.');
                                     }
                                });
                                var calendar = $('#calendar').calendar(options);
                                calendar.setLanguage("es-ES");
                                calendar.view();

                        });
		},
		onAfterViewLoad: function(view) {
			$('h3').text(this.getTitle());
			$('.btn-group button').removeClass('active');
			$('button[data-calendar-view="' + view + '"]').addClass('active');
		},
		classes: {
			months: {
				general: 'label'
			}
		}
	};
        
	var calendar = $('#calendar').calendar(options);
        calendar.setLanguage("es-ES");
        calendar.view();      
	$('.btn-group button[data-calendar-nav]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.navigate($this.data('calendar-nav'));
		});
	});

	$('.btn-group button[data-calendar-view]').each(function() {
		var $this = $(this);
		$this.click(function() {
			calendar.view($this.data('calendar-view'));
		});
	});

	$('#first_day').change(function(){
		var value = $(this).val();
		value = value.length ? parseInt(value) : null;
		calendar.setOptions({first_day: value});
		calendar.view();
	});

	$('#language').change(function(){
		calendar.setLanguage($(this).val());
		calendar.view();
	});

	$('#events-in-modal').change(function(){
		var val = $(this).is(':checked') ? $(this).val() : null;
		calendar.setOptions({modal: val});
	});
	$('#events-modal .modal-header, #events-modal .modal-footer').click(function(e){
		//e.preventDefault();
		//e.stopPropagation();
	});
//admin
        $('#commit').click(function(){
            if(!$('#title').val()){
                 $('#resultado').attr("class","col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center label-danger");
                 $('#resultado').html('Titulo Obligatorio.');
            }else if (!$('#from input').val()){
                 $('#resultado').attr("class","col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center label-danger");
                 $('#resultado').html('Fecha Inicio Obligatorio.');
            }else if (!$('#to input').val()){
                 $('#resultado').attr("class","col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center label-danger");
                 $('#resultado').html('Fecha Fin Obligatorio.');
            }else{
                var evento =
                             
                    {
                            "title": $('#title').val(),
                            "url": $('#url').val(),
                            "class": $('#class').val(),
                            "start": $('#from input').val(),
                            "end":   $('#to input').val()
                    }   
                 ;
                $.ajax({
                    data: evento,
                    //Cambiar a type: POST si necesario
                    type: "POST",
                    dataType: "json",
                    url: "../CALENDARIO/events_json_alta.php",
                })
                 .done(function( data, textStatus, jqXHR ) {
                     if ( data.success ) {
                         console.log( "La solicitud se ha completado correctamente." );
                         $('#resultado').attr("class","col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center label-success");
                         $('#resultado').html('Añadido correctamente.');
                     }else{
                         console.log( "La solicitud ha fallado." );
                         $('#resultado').attr("class","col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center label-danger");
                         $('#resultado').html('Se ha producido un error de BBDD.');
                     }
                 })
                 .fail(function( jqXHR, textStatus, errorThrown ) {
                     if ( console && console.log ) {
                         console.log( "La solicitud ha fallado: " +  textStatus);
                         $('#resultado').attr("class","col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center label-danger");
                         $('#resultado').html('Se ha producido un error.');
                     }
                });
                var calendar = $('#calendar').calendar(options);
                calendar.setLanguage("es-ES");
                calendar.view();
                
            }
        });

}(jQuery));