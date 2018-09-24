(function () {
  'use strict';

  var INPUTS = {
    email: '',
    name: '',
    phone: '',
    type: {
      id: 0,
    },
  };

  var SETTING_TO_ROLE = {
    'pkg.rwhois.allow_role.abuse': {
      id: 0,
      name: 'Abuse',
    },
    'pkg.rwhois.allow_role.poc': {
      id: 1,
      name: 'POC',
    },
    'pkg.rwhois.allow_role.tech': {
      id: 2,
      name: 'Tech',
    },
  };

  angular
    .module('pkg.rwhois')
    .component('pkgRwhoisContactForm', {
      require: {},
      bindings: {
        form: '=',
      },
      controller: 'PkgRwhoisContactFormCtrl as contactForm',
      transclude: true,
      templateUrl: function (RouteHelpers) {
        "ngInject";
        return RouteHelpers.trusted(
          RouteHelpers.package('rwhois')
            .asset(
              'client/contact/form.html'
            )
        );
      }
    })
    .controller('PkgRwhoisContactFormCtrl', ContactFormCtrl)
    .service('PkgRwhoisAllowedRoles', AllowedRoles)
  ;

  /**
   * @ngInject
   */
  function AllowedRoles(Api) {
    var singletonPromise;
    return {
      get: get,
    };

    function get() {
      return singletonPromise = singletonPromise || Api
        .all('setting-group')
        .getList()
        .then(function (groups) {
          var allowedRoles = [];
          groups.map(function (group) {
            group.settings.map(function (setting) {
              Object.entries(SETTING_TO_ROLE)
                .map(function (entry) {
                  if (setting.slug === entry[0] && setting.value) {
                    allowedRoles.push(entry[1]);
                  }
                });
            });
          });
          return allowedRoles;
        });
    }
  }

  /**
   * @ngInject
   */
  function ContactFormCtrl(_, RouteHelpers, Loader, EventEmitter, PkgRwhoisAllowedRoles) {
    var contactForm = this;

    contactForm.allowedRoles = [];
    contactForm.loader = Loader();
    contactForm.$onInit = init;
    contactForm.input = _.clone(INPUTS);

    EventEmitter()
      .bindTo(contactForm);

    RouteHelpers.loadLang('pkg:rwhois:client:contact');

    //////////

    function init() {
      contactForm.form.getData = getData;
      fillFormInputs();

      (contactForm.form.on || function () {
      })(['change', 'load'], storeState);

      contactForm.loader.during(
        PkgRwhoisAllowedRoles.get()
          .then(function (roles) {
            _.setContents(contactForm.allowedRoles, roles);
            contactForm.input.type.id = contactForm.allowedRoles.length ? contactForm.allowedRoles[0].id : undefined;
          })
      );
    }

    function getData() {
      return _.clone(contactForm.input);
    }

    function fillFormInputs() {
      _.overwrite(contactForm.input, contactForm.form.input);
    }

    function storeState(response) {
      fillFormInputs();
    }
  }
})();
