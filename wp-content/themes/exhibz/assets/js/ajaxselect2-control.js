jQuery( window ).on( 'elementor:init', function() {
	var ControlAjaxselect2ItemView = elementor.modules.controls.BaseData.extend( {
		onReady: function() {
      var self = this;
      var el = self.ui.select;
      var url = el.attr('data-ajax-url');
      
			el.select2({
        ajax: {
          url: url,
          dataType: 'json',
          data: function (params) {
            var query = {
              s: params.term,
            }
            return query;
          }
        },
        cache: true,
      });

      var ids = (self.getControlValue().length > 0) ? self.getControlValue().join() : '';
      $.ajax({
        url: url,
        dataType: 'json',
        data: {
          ids: ids,
        }
      }).then(function (data) {
        
        if(data != null && data.results.length > 0){
          $.each(data.results, function(i, v){
            var option = new Option(v.text, v.id, true, true);
            el.append(option).trigger('change');
          });
          el.trigger({
              type: 'select2:select',
              params: {
                  data: data
              }
          });
        }
      });

    },
    onBeforeDestroy: function onBeforeDestroy() {
      if (this.ui.select.data('select2')) {
        this.ui.select.select2('destroy');
      }
  
      this.$el.remove();
    }  
	});
	elementor.addControlView( 'ajaxselect2', ControlAjaxselect2ItemView );
});
