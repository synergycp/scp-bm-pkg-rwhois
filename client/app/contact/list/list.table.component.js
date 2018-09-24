(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact.list')
    .component('pkgRwhoisContactTable', {
      require: {
        list: '\^list',
      },
      bindings: {
        showName: '=?',
        showEmail: '=?',
        showPhone: '=?',
        showRole: '=?',
        showActions: '=?',
      },
      controller: 'PkgRwhoisContactTableCtrl as table',
      transclude: true,
      templateUrl: tableTemplateUrl
    })
    .controller('PkgRwhoisContactTableCtrl', ContactTableCtrl)
  ;

  /**
   * @ngInject
   */
  function tableTemplateUrl(RouteHelpers) {
    return RouteHelpers.trusted(
      RouteHelpers.package('rwhois')
        .asset(
          'client/contact/list/list.table.html'
        )
    );
  }

  /**
   * @ngInject
   */
  function ContactTableCtrl() {
    var table = this;

    table.$onInit = init;

    ///////////

    function init() {
      _.defaults(table, {
        showName: true,
        showEmail: true,
        showPhone: true,
        showRole: true,
        showActions: true,
      });
    }
  }
})();
