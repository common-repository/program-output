(function() {
     /* Register the buttons */
     tinymce.create('tinymce.plugins.MyButtons', {
          init : function(ed, url) {
               /**
               * Inserts shortcode content
               */
               ed.addButton( 'button_console', {
                    title : 'Console Otput',
                    // image : '../wp-includes/images/smilies/icon_eek.gif',
                    image : '../wp-content/plugins/program-output/admin/img/console-icon.png',
                    // text: 'My button',
                    // icon: false,

                    onclick : function() {
                         ed.selection.setContent('[output type="cmd"]Hello World[/output]');
                    }
               });
               /**
               * Inserts shortcode content
               */
               ed.addButton( 'button_browser', {
                    title : 'Browser Output',
                    image : '../wp-content/plugins/program-output/admin/img/browser-icon.png',
                    onclick : function() {
                         ed.selection.setContent('[output type="browser"]Hello World[/output]');
                    }
               });
          },
          createControl : function(n, cm) {
               return null;
          },
     });
     /* Start the buttons */
     tinymce.PluginManager.add( 'my_button_script', tinymce.plugins.MyButtons );
})();