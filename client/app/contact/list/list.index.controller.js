(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact.list')
    .controller('ContactIndexCtrl', ContactIndexCtrl)
  ;

  /**
   * @ngInject
   */
  function ContactIndexCtrl(ContactList, ListFilter, _) {
    var vm = this;

    vm.list = ContactList();
    vm.filters = ListFilter(vm.list);

    vm.create = {
      input: {},
      submit: create,
    };

    vm.logs = {
      filter: {
        target_type: 'pkg.rwhois.contact',
      },
    };

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
