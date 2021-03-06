<!DOCTYPE html>
<html>
<head>
	<title>Calendario</title>

	<meta name="description" content="Full view calendar component for twitter bootstrap with year, month, week, day views.">
	<meta name="keywords" content="jQuery,Bootstrap,Calendar,HTML,CSS,JavaScript,responsive,month,week,year,day">
	<meta name="author" content="Serhioromano">
	<meta charset="UTF-8">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="../CALENDARIO/components/bootstrap2/css/bootstrap-responsive.css">
	<link rel="stylesheet" href="../css/calendar.css">
        <link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css" />

</head>
<body>
<div class="container fondoblanco">
<?php require_once '../librerias/header.php';?>

	<div class="page-header">

		<div class="pull-right form-inline">
			<div class="btn-group">
				<button class="btn btn-primary" data-calendar-nav="prev"><< Prev</button>
				<button class="btn" data-calendar-nav="today">HOY</button>
				<button class="btn btn-primary" data-calendar-nav="next">Next >></button>
			</div>
			<div class="btn-group">
				<button class="btn btn-warning" data-calendar-view="year">Año</button>
				<button class="btn btn-warning active" data-calendar-view="month">Mes</button>
				<button class="btn btn-warning" data-calendar-view="week">Semana</button>
				<button class="btn btn-warning" data-calendar-view="day">Día</button>
			</div>
		</div>

		<h3 id="mes"></h3>
		
	</div>

	<div class="row marginbotlow">
		<div class="col-xs-8 col-lg-8 col-md-8 col-sm-8">
			<div id="calendar"></div>
		</div>
		<div class="col-xs-4 col-lg-4 col-md-4 col-sm-4">

			<h4>Eventos</h4>
			<small>Listado de eventos</small>
			<ul id="eventlist" class="nav nav-list"></ul>
		</div>
	</div>

	<div class="clearfix"></div>


        <div id="disqus_thread">
            <div id="resultado" class="col-xs-12 col-lg-12 col-md-12 col-sm-12 text-center hidden">Correcto</div>
            <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
            <h1 class="text-center heading">Añadir un nuevo evento</h1><hr>

                <div class="col-sm-8 col-sm-offset-2">
                   <div class='col-md-6'>
                        <div class="form-group">
                            <div class='input-group date' id='from'>
                                <input type='text' name="from" class="form-control" readonly />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <div class="form-group">
                            <div class='input-group date' id='to'>
                                <input type='text' name="to" class="form-control" readonly />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url" class="col-sm-12 control-label">Enlace al evento</label>
                        <div class="col-sm-12">
                          <input type="url" name="url" class="form-control" id="url" placeholder="Introduce una url o no :)">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Tipo de evento</label>
                        <div class="col-sm-12">
                            <select class="form-control" name="class" id="class">
                                <option value="event-info">Azul</option>
                                <option value="event-success">Verde</option>
                                <option value="event-inverse">Negro</option>
                                <option value="event-important">Rojo</option>
                                <option value="event-warning">Amarillo</option>
                                <option value="event-special">Violeta</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title" class="col-sm-12 control-label">Título</label>
                        <div class="col-sm-12">
                          <input type="text" name="title" class="form-control" id="title" placeholder="Introduce un título">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="body" class="col-sm-12 control-label">Evento</label>
                        <div class="col-sm-12">
                          <textarea id="body" name="event" class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <input id="commit" style="margin-top: 10px" type="submit" class="pull-right btn btn-success marginbotlow" value="Guardar Evento">
                    </div>
                </div>
        </div>

	<div class="modal hide fade" id="events-modal">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3>Event</h3>
		</div>
		<div class="modal-body" style="height: 400px">
		</div>
		<div class="modal-footer">
			<a href="#" data-dismiss="modal" class="btn">Close</a>
		</div>
	</div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="../js/moment.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bootstrap-datetimepicker.js"></script>  
        <script type="text/javascript" src="../CALENDARIO/components/underscore/underscore-min.js"></script>
	<script type="text/javascript" src="../CALENDARIO/components/jstimezonedetect/jstz.min.js"></script>
	<script type="text/javascript" src="../js/es-ES.js"></script>
	<script type="text/javascript" src="../js/calendar.js"></script>
	<script type="text/javascript" src="../js/app.js"></script>

        <script type="text/javascript">
            $(function () {
                $('#from').datetimepicker({
                    language: 'es',
                    minDate: new Date()
                });
                $('#to').datetimepicker({
                    language: 'es',
                    minDate: new Date()
                });

            });
<?php require_once '../librerias/logoanimado.php';?>    
        </script>


</div>
</body>
</html>
