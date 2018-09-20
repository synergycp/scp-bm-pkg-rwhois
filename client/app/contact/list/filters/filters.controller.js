(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact.list.filters')
    .controller('ContactFiltersCtrl', ContactFiltersCtrl)
    ;

  /**
   * @ngInject
   */
  function ContactFiltersCtrl(Select, Observable, $state, $q, $timeout) {
    var filters = this;

    filters.$onInit = init;
    filters.$onChanges = $onChanges;

    filters.current = {
      q: $state.params.q,
    };
    filters.searchFocus = Observable(false);

    filters.fireChangeEvent = fireChangeEvent;

    //////////

    function init() {
      var promises = [
        $timeout(),
        // filters.contact.setSelectedId($state.params['contact']),
      ];

      $q.all(promises)
        .then(listenForChanges)
        .then(fireChangeEvent)
        ;
    }

    function listenForChanges() {
      // filters.contact.on('change', fireChangeEvent);
    }

    function fireChangeEvent() {
      _.assign(filters.current, {
        // contact: filters.contact.getSelected('id'),
      });

      $state.go($state.current.name, {
        // 'contact': filters.current.contact,
        'q': filters.current.q,
      });

      if (filters.change) {
        filters.change();
      }
    }

    function $onChanges(changes) {
      if (changes.show) {
        var onShow = filters.searchFocus.set.bind(null, true);
        (changes.show.currentValue ? onShow : angular.noop)();
      }
    }
  }
})();
