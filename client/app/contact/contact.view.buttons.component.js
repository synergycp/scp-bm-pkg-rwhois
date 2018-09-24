(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact')
    .component('pkgRwhoisContactButtons', {
      require: {},
      bindings: {
        contact: '=',
      },
      controller: 'PkgRwhoisContactButtonsCtrl as buttons',
      transclude: true,
      templateUrl: function(RouteHelpers) {
        "ngInject";
        return RouteHelpers.trusted(
          RouteHelpers.package('rwhois').asset(
            'client/contact/contact.view.buttons.html'
          )
        );
      }
    })
    .controller('PkgRwhoisContactButtonsCtrl', PkgRwhoisContactButtonsCtrl);

  /**
   * @ngInject
   */
  function PkgRwhoisContactButtonsCtrl(PkgRwhoisContactList, Loader, $state) {
    var buttons = this;

    buttons.loader = Loader();
    buttons.$onInit = init;
    buttons.delete = doDelete;


    //////////

    function init() {

    }

    function doDelete() {
      return buttons.loader.during(
        PkgRwhoisContactList()
          .confirm
          .delete([buttons.contact])
          .result.then(transferToList)
      );
    }

    function transferToList() {
      $state.go('app.pkg.rwhois.contact.list');
    }
  }
})();
