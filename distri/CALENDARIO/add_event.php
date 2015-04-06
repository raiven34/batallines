<!DOCTYPE html>
<html>
<head>
	<title>Crear un nuevo evento</title>
    <meta charset="utf-8">
	<head>
	  	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	  	<script src="../js/moment.js"></script>
                <script src="../js/bootstrap.min.js"></script>
	  	<script src="../js/bootstrap-datetimepicker.js"></script>
	  	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	  	<link rel="stylesheet" href="../css/bootstrap-datetimepicker.min.css" />
	   <script src="../js/bootstrap-datetimepicker.es.js"></script>
    </head>
</head>
<body>
<div class="container">
    <ol class="breadcrumb">
        <li><a href="calendar">Calendario</a></li>
        <li><a href="events">Añadir evento</a></li>
    </ol>
    <div class="row">
    <h1 class="text-center heading">Añadir un nuevo evento</h1><hr>

        <div class="col-sm-8 col-sm-offset-2" style="height:75px;">
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
                    <select class="form-control" name="class">
                        <option value="event-info">Info</option>
                        <option value="event-success">Success</option>
                        <option value="event-inverse">Inverse</option>
                        <option value="event-important">Important</option>
                        <option value="event-warning">Warning</option>
                        <option value="event-special">Special</option>
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

             <input style="margin-top: 10px" type="submit" class="pull-right btn btn-success" value="Gurdar evento">
            </div>
        </div>

    </div>
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
    </script>
</div>
</body>
</html>