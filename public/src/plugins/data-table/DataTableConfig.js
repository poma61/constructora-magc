      //Carga el archivo Spanish.json de forma síncrona
      import config from '/src/js/config.js';
      let es_json = config.BASE_URL+'/src/plugins/data-table/es.json';
      $.ajax({
          url: es_json,
          dataType: "json",
          async: true,
          success: function(data) {
             let  translations = data;
              // Configuración de la traducción global al español
              $.extend(true, $.fn.dataTable.defaults, {
                  language: translations,
              });
          }
      });
      