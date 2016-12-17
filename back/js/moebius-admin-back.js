(function($) {
  'use strict';

  var principal = document.getElementById('list-equipo-principal');
  var collaborators = document.getElementById('list-colaboradores');

  if (principal) {
    var pSortable = Sortable.create(principal, {
      animation: 150,
      onEnd: onEndHandler
    });
  }

  if (collaborators) {
    var cSortable = Sortable.create(collaborators, {
      animation: 150,
      onEnd: onEndHandler
    });
  }

  function onEndHandler(evt) {
    var usersList = document.querySelectorAll('.moebius-user-field');
    for (var i = 0; i < usersList.length; i++) {
      usersList[i].value = i;
    }
  }
})(jQuery);
