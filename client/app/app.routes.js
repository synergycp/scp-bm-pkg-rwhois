(function () {
  angular
    .module('pkg.rwhois')
    .config(routeConfig)
    ;

  /**
   * @ngInject
   */
  function routeConfig(RouteHelpersProvider) {
    var helper = RouteHelpersProvider;
    var pkg = helper.package('rwhois');

    pkg.state('');
  }
})();
