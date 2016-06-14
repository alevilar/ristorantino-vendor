<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '48ecb83a8cbef6e7937d121a73a507f064ec44f8';

window.smartsupp||(function(d) {
    var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
    s=d.getElementsByTagName('script')[0];c=d.createElement('script');
    c.type='text/javascript';c.charset='utf-8';c.async=true;
    c.src='//www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);

// customize banner & logo
    //smartsupp('banner:set', 'bubble');
    //smartsupp('theme:set', 'arrow');

    smartsupp('chat:avatar', '<?php echo $this->Html->url("/paxapos/img/chat-avatar.png")?>');
    // customize texts
    smartsupp('chat:translate', {
        online: {
            infoTitle: 'Hola, soy Lucía',
        },
        widget: { // chat box
            online: 'Soporte Técnico Online',
        },
    });
   

    // customize colors
    smartsupp('theme:colors', {
        primary: '#B71D21',
        banner: '#999999',
        primaryText: '#ffffff',
    });

    smartsupp('theme:options', {
        widgetHeight: 50
    });



    smartsupp('theme:styles', 'custom', {
        '#widgetPanel': {
            'font-size': '15px;',
            'box-shadow': "0px 0px 10px 1px #333"
        }
    });

    
    smartsupp('on', 'status', function(status) {
        if( status == 'offline') {
           
                    
            smartsupp('theme:styles', 'custom', {
                '#widgetPanel': {
                    'display': 'none !important',

                }
            });
        }
    });
</script>