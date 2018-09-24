(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact.list.filters')
    .component('pkgRwhoisContactFilters', {
      require: {
        list: '\^list',
      },
      bindings: {
        show: '<',
        current: '=',
        change: '&?',
      },
      controller: 'PkgRwhoisContactFiltersCtrl as filters',
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
