(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact.list.filters')
    .component('contactFilters', {
      require: {
        list: '\^list',
      },
      bindings: {
        show: '<',
        current: '=',
        change: '&?',
      },
      controller: 'ContactFiltersCtrl as filters',
      transclude: true,
      templateUrl: function(RouteHelpers) {
          "ngInject";
          return RouteHelpers.trusted(
              RouteHelpers.package('rwhois').asset(
                  'client/contact/list/filters/filters.html'
              )
          );
      }
    })
    ;
})();
