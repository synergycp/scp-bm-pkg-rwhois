(function () {
  angular
    .module('pkg.rwhois.contact')
    .config(routeConfig)
    ;

  /**
   * @ngInject
   */
  function routeConfig($stateProvider, RouteHelpersProvider) {
    var helper = RouteHelpersProvider;
      var pkg = helper.package('rwhois');
      pkg
        .state('contact', {
          url: '/contact',
          abstract: true,
          template: helper.dummyTemplate,
          resolve: helper.resolveFor(pkg.lang('client:contact')),
        })
        .state('contact.view', {
          url: '/:id',
          title: 'View Contact',
          controller: 'ContactViewCtrl as vm',
          templateUrl: pkg.asset('client/contact/contact.view.html'),
        })
        .url('contact/?([0-9]*)', mapReportUrl)
        .sso('contact', function($state, options) {
            return mapReportUrl($state, options.id);
        })
      ;

      function mapReportUrl($state, id) {
          return $state.href('contact.' + (id ? 'view' : 'list'), {
              id: id,
          });
      }
  }
})();
