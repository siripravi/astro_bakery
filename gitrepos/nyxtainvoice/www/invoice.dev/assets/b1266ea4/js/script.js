
function getItemFormat(item) {
  var format = '<div>' + item.text + '</div>';
  return format;
}

$(function() {
  $('#custId').select2({
    minimumInputLength: 2,
    placeholder: 'Type Customer name',
    allowClear: true,
    ajax: {
      url: '/copyright.json',
      dataType: 'json',
      quietMillis: 250,
      data: function (term, page) {
        return {
          q: term
        };
      },
      results: function (data, page) {
        return { results: data, id: 'ItemId', text: 'ItemText' };
      }
    },
  //  formatResult: getItemFormat,
    dropdownCssClass: "bigdrop",
    escapeMarkup: function (m) { return m; }
  });
  
  $('#venId').select2({
    minimumInputLength: 2,
    placeholder: 'Type venue name',
    allowClear: true,   
    dropdownCssClass: "bigdrop",
    escapeMarkup: function (m) { return m; }
  });
  
});


