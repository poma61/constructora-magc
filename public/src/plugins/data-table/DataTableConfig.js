      // Carga el archivo Spanish.json de forma síncrona
      var es_json = BASE_URL+'/src/plugins/data-table/es.json';
      $.ajax({
          url: es_json,
          dataType: "json",
          async: false,
          success: function(data) {
              translations = data;
              // Configuración de la traducción global al español
              $.extend(true, $.fn.dataTable.defaults, {
                  language: translations,
              });
          }
      });
      