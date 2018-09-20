(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact.list')
    .component('contactTable', {
      require: {
        list: '\^list',
      },
      bindings: {
        showIp: '=?',
        showContact: '=?',
        showActions: '=?',
      },
      controller: 'ContactTableCtrl as table',
      transclude: true,
      templateUrl: tableTemplateUrl
    })
    .controller('ContactTableCtrl', ContactTableCtrl)
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
        showIp: true,
        showContact: true,
        showActions: true,
      });
    }
  }
})();
