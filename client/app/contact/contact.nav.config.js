(function () {
    'use strict';

    angular
        .module('pkg.rwhois.contact')
        .constant('PkgRdnsContactNav', {
            text: "RWhois Contacts",
            sref: "app.pkg.rwhois.contact.list",
        })
        .config(NavConfig)
    ;

    /**
     * @ngInject
     */
    function NavConfig(NavProvider, PkgRdnsContactNav) {
        NavProvider
            .group('network')
            .item(PkgRdnsContactNav)
        ;
    }
})();
