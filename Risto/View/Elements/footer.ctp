
<footer id="p-footer" class="hidden-print">
	<?php echo $this->element('Risto.google_ads/horizontal'); ?> 
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4">
                <div class="p-links text-center">
                            <?php
                             echo $this->Html->link('Términos y Condiciones', array('plugin'=>false, 'controller'=>'pages', 'action'=>'tos')); 
                             ?>                                     
                            <br>
                            <?php

                            echo $this->Html->link('Contacto',
                                array('plugin'=>'paxapos', 'controller'=>'paxapos', 'action'=>'contact')
                                );
                            ?>
                            <br>
                            <small>
                                info@paxapos.com<br>
                                Av del Mar 32, esquina Bunge.<br>
                                Pinamar, Buenos Aires, Argentina.
                            </small>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="p-logo-footer">
                    <span class="hide">PaxaPos</span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="p-social-media">
                        <ul class="nav list-unstyled">
                            <li class="img-circle"><a href="https://facebook.com/paxapos" class="p-sm-facebook"><span class="hide">Facebook</span></a></li>
                            <li class="img-circle"><a href="https://www.youtube.com/channel/UCa90_rTOMD4qdOhi2WQV6rw" class="p-sm-youtube"><span class="hide">Youtube</span></a></li>
                            <li class="img-circle"><a href="https://twitter.com/paxapos" class="p-sm-twitter"><span class="hide">Twitter</span></a></li>
                            <li class="img-circle"><a href="http://forum.paxapos.com" class="p-sm-forum"><span class="hide">Foro</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>    
        <div class="clearfix"></div>         
    </div>
    
</footer>  