(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact')
    .controller('PkgRwhoisContactViewCtrl', PkgRwhoisContactViewCtrl)
    ;

  /**
   * View ForwardGateway Controller
   *
   * @ngInject
   */
  function PkgRwhoisContactViewCtrl(Edit, $stateParams) {
    var vm = this;

    vm.edit = Edit('pkg/rwhois/contact/'+$stateParams.id);
    vm.edit.submit = submit;

    activate();

    //////////

    function activate() {
      vm.edit.getCurrent();
    }

    function submit() {
      vm.edit.patch(vm.edit.getData());
    }
  }
})();
