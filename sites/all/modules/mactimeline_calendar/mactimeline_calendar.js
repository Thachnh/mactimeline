


Drupal.behaviors.mactimeline_calendar = function() {
  var now = new Date();

  var ts = '';

  ts += now.getFullYear() + '-';

  var m = '' + (now.getMonth() + 1);

  if (m.length == 1) {
    ts += '0';
  }
  ts += m + '-';

  var d = '' + now.getDate();

  if (d.length == 1) {
    ts += '0';
  }
  ts += d;


  $('.date-' + ts).addClass('date-today');

}

