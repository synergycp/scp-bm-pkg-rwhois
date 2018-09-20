(function () {
  'use strict';

  angular
    .module('pkg.rwhois.contact.list')
    .factory('ContactList', ContactListFactory);

  /**
   * ContactList Factory
   *
   * @ngInject
   */
  function ContactListFactory(ListConfirm, List, RouteHelpers) {
    var pkg = RouteHelpers.package('rwhois');
    return function () {
      var list = List(pkg.api().all('contact'));
      list.confirm = ListConfirm(list, 'pkg.rwhois.client.contact.modal.delete');

      list.bulk.add('Delete', list.confirm.delete);

      return list;
    };
  }
})();
