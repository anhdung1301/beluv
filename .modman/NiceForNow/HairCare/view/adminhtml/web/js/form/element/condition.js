define([
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select',
    'Magento_Ui/js/modal/modal',
    'mage/url'
], function (_, uiRegistry, select, modal, url) {
    'use strict';
    return select.extend({
        defaults: {
            subOptions: null,
            subElems: 'sub_id'
        },
        /**
         * Init
         */
        initialize: function () {
            this._super();
            // var Sub = uiRegistry.get('index = sub_id');
            // Sub.hide();
            this.fieldDepend(this.value());
            return this;
        },

        /**
         * On value change handler.
         *
         * @param {String} value
         */
        onUpdate: function (value) {
            this.fieldDepend(value);
            return this._super();

        },

        /**
         * Update field dependency
         *
         * @param {String} value
         */

        fieldDepend: function (value) {
            // var linkUrl = url.build('/rest/V1/haircare/post/');
            var linkUrl = "/admin/haircare/index/getAjax";

            jQuery.ajax({
                type: "POST",
                url: linkUrl,
                dataType: "json",
                data: {
                    id: value,
                },
                success: function (data) {
                    subOptions:data;

                },
                error: function () {

                }
            });
            return this;
        }
        
    });
});