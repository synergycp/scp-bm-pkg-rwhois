(function () {
  'use strict';

  var INPUTS = {
    email: '',
    password: '',
    first: '',
    last: '',
    billing: {
      id: '',
      ignoreAutoSuspend: false,
    },
  };

  angular
    .module('pkg.rwhois')
    .component('pkgRwhoisContactForm', {
      require: {},
      bindings: {
        form: '=',
      },
      controller: 'PkgRwhoisContactFormCtrl as pkgRwhoisContactForm',
      transclude: true,
      templateUrl: function (RouteHelpers) {
        "ngInject";
        return RouteHelpers.trusted(
          RouteHelpers.package('rwhois')
            .asset(
              'client/contact/list/list.form.html'
            )
        );
      }
    })
    .controller('PkgRwhoisContactFormCtrl', ContactListFormCtrl)
  ;

  /**
   * @ngInject
   */
  function ContactListFormCtrl(_, RouteHelpers, Loader, EventEmitter) {
    var contactListForm = this;

    contactListForm.allowed_roles = {
      tech: true,
      poc: true,
      abuse: true,
    };
    contactListForm.loader = Loader();
    contactListForm.$onInit = init;
    contactListForm.input = _.clone(INPUTS);

    EventEmitter()
      .bindTo(contactListForm);

    RouteHelpers.loadLang('pkg:rwhois:client:contact');

    //////////

    function init() {
      clientForm.form.getData = getData;
      fillFormInputs();

      (clientForm.form.on || function () {
      })(['change', 'load'], storeState);
    }

    function getData() {
      return _.clone(clientForm.input);
    }

    function fillFormInputs() {
      _.overwrite(clientForm.input, clientForm.form.input);
    }

    function storeState(response) {
      fillFormInputs();
    }
  }
})();
