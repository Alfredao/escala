<?php 

$data = filter_input(INPUT_GET, 'data');

$timeWeb1 = 'Alfredo, Débora e Fernando';
$timeWeb2 = 'Gabriel, Jerfeson, Sérgio e Vagner';

$timeDesktop1 = 'Anderson e Thiago';
$timeDesktop2 = 'Erik e Julianno';

$date  = new \DateTime($data);

$date2 = clone $date;
$date2->modify('next sunday');

if ($date->format("W") % 2 == 0) {
    
    $escalaAtendimento = 'DESKTOP';
    
    if ($date->format("N") % 2 == 0) {
        $escalaWeb = '12h ' . $timeWeb1 . '<br  />' . '13h ' . $timeWeb2;
        $escalaDesk = '12h ' . $timeDesktop1 . '<br  />' . '13h ' . $timeDesktop2;
    } else {
        $escalaWeb = '12h ' . $timeWeb2 . '<br  />' . '13h ' . $timeWeb1;
        $escalaDesk = '12h ' . $timeDesktop2 . '<br  />' . '13h ' . $timeDesktop1;
    }
} else {
    
    $escalaAtendimento = 'WEB';
    
    if ($date->format("N") % 2 != 0) {
        $escalaWeb = '12h ' . $timeWeb1 . '<br  />' . '13h ' . $timeWeb2;
        $escalaDesk = '12h ' . $timeDesktop1 . '<br  />' . '13h ' . $timeDesktop2;
    } else {
        $escalaWeb = '12h ' . $timeWeb2 . '<br  />' . '13h ' . $timeWeb1;
        $escalaDesk = '12h ' . $timeDesktop2 . '<br  />' . '13h ' . $timeDesktop1;
    }
}

?>
<!DOCTYPE html>
<html ng-app="myApp">
    <head>
        <meta charset="utf-8" />
        <title>Escalas</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
        
        <script src="//code.jquery.com/jquery-3.2.1.slim.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <script>
        $(document).ready(function() {
            var clipboard = new Clipboard('.btn');
            
            clipboard.on('success', function(e) {
                $(e.trigger).tooltip('hide').attr('data-original-title', 'Copiado!').tooltip('show');
            });
            
            clipboard.on('error', function(e) {
                
            });
        });
        </script>
        
    </head>
    <body>
        <div class="col-lg-6">
        <h3><?php echo $date->format('d/m/Y'); ?></h3>

        <h4>Escala atendimento</h4>
        <?php echo $escalaAtendimento; ?> até <?php echo $date2->format('d/m/Y'); ?>

        <h4>Escala almoço</h4>
        <table class="table table-bordered">
            <tr>
                <th>WEB <button class="btn btn-xs pull-right" data-clipboard-action="copy" data-clipboard-target="#escala-web"><i class="fa fa-files-o"></i></button></th>
                <th>DESKTOP <button class="btn btn-xs pull-right" data-clipboard-action="copy" data-clipboard-target="#escala-desk"><i class="fa fa-files-o"></i></button></th>
            </tr>
            <tr>
                <td id="escala-web" class="col-lg-6"><?php echo $escalaWeb; ?></td>
                <td id="escala-desk" class="col-lg-6"><?php echo $escalaDesk; ?></td>
            </tr>    
        </table>
        </div>
    </body>
</html>
