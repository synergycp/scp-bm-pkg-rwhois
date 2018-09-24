(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact.list')
    .controller('ContactIndexCtrl', ContactIndexCtrl)
  ;

  /**
   * @ngInject
   */
  function ContactIndexCtrl(PkgRwhoisContactList, PkgRwhoisAllowedRoles, ListFilter, _, Loader) {
    var vm = this;

    vm.list = PkgRwhoisContactList();
    vm.filters = ListFilter(vm.list);

    vm.create = {
      input: {},
      submit: create,
    };

    vm.allowedRoles = [];
    vm.allowedRolesLoader = Loader();

    vm.allowedRolesLoader.during(
      PkgRwhoisAllowedRoles.get().then(function (allowedRoles) {
        _.setContents(vm.allowedRoles, allowedRoles);
        console.log(allowedRoles);
      })
    );

    activate();

    ////////////

    function activate() {
      vm.list.load();
    }

    function create() {
      var data = vm.create.getData();

      vm.list.create(data);
    }
  }
})();
