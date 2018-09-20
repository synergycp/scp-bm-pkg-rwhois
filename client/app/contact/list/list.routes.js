(function () {
  angular
    .module('pkg.rwhois.contact.list')
    .config(routeConfig)
    ;

  /**
   * @ngInject
   */
  function routeConfig($stateProvider, RouteHelpersProvider) {
    var helper = RouteHelpersProvider;
      var pkg = helper.package('rwhois');
      pkg
      .state('contact.list', {
        url: '?q',
        title: 'Contacts',
        controller: 'ContactIndexCtrl as vm',
        reloadOnSearch: false,
        templateUrl: pkg.asset('client/contact/list/list.index.html'),
      })
      ;
  }
})();
