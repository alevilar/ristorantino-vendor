<div data-role="page" id="mesas-cobradas">
    <div data-role="content">
        <ul data-role="listview" data-filter="true" id="">
            <?php
            $this->title_for_layout = 'Últimas Cobradas';

            foreach ($mesas as $m) {

                echo "<li>" .
                $this->Html->link(
                        __("%s N° %s %s %s. Cobrada el %s", Configure::read('Mesa.tituloMesa'), $m['numero'], Configure::read('Mesa.tituloMozo'), $m['Mozo']['numero'] ,  date('d M H:i', strtotime($m['time_cobro']))
                        , array(
                                'plugin' => 'mesa',
                                'controller' => 'mesas',
                                'action' => 'edit',
                                $m['id']
                            )
                        , array(
                            'data-rel' => "dialog",
                            'data-mesa' => json_encode($m)
                        )
                )
                . "</li>";
            }
            ?>

        </ul>
    </div>

</div>