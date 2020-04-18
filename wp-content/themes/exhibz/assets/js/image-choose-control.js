jQuery( window ).on( 'elementor:init', function() {
var ControlBaseDataView = elementor.modules.controls.BaseData;
ControlImageChooseItemView = ControlBaseDataView.extend({
ui: function ui() {
  var ui = ControlBaseDataView.prototype.ui.apply(this, arguments);

  ui.inputs = '[type="radio"]';

  return ui;
},

events: function events() {
  return _.extend(ControlBaseDataView.prototype.events.apply(this, arguments), {
    'mousedown label': 'onMouseDownLabel',
    'click @ui.inputs': 'onClickInput',
    'change @ui.inputs': 'onBaseInputChange'
  });
},

onMouseDownLabel: function onMouseDownLabel(event) {
  var $clickedLabel = this.$(event.currentTarget),
      $selectedInput = this.$('#' + $clickedLabel.attr('for'));

  $selectedInput.data('checked', $selectedInput.prop('checked'));

  this.ui.inputs.removeClass('checked');
  $selectedInput.data('checked', $selectedInput.addClass('checked'));
},

onClickInput: function onClickInput(event) {
  if (!this.model.get('toggle')) {
    return;
  }

  var $selectedInput = this.$(event.currentTarget);

  if ($selectedInput.data('checked')) {
    $selectedInput.prop('checked', false).trigger('change');
  }
},

onRender: function onRender() {
  ControlBaseDataView.prototype.onRender.apply(this, arguments);

  var currentValue = this.getControlValue();

  if (currentValue) {
    this.ui.inputs.filter('[value="' + currentValue + '"]').prop('checked', true);
    this.ui.inputs.filter('[value="' + currentValue + '"]').addClass('checked');
  }
}
}, {

onPasteStyle: function onPasteStyle(control, clipboardValue) {
  return '' === clipboardValue || undefined !== control.options[clipboardValue];
}
});
elementor.addControlView( 'imagechoose', ControlImageChooseItemView );
});
