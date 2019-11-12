define([
    'jquery',
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select',
    'mage/url',
    'uiRegistry'
], function ($, _, uiRegistry, select) {
    'use strict';
    return select.extend({
        // defaults: {
        //     listens: {
        //         '${ $.provider }:data.sub_id': 'setDifferedFromDefault'
        //     }
        // },
        // setDifferedFromDefault: function (value) {
        //     console.log(value);
        // },
        initialize: function () {
            this._super();

            var subSelectedId = this.source.data['sub_id'];
            this.getSubConditions(parseInt(this.initialValue), subSelectedId);
            return this;
        },

        /**
         * On value change handler.
         *
         * @param {String} value
         */
        onUpdate: function (value) {
            this.getSubConditions(parseInt(value));
            return this;
        },

        /**
         *
         * @param value
         * @returns {exports}
         */

        getSubConditions: function (value, subSelectedId = null) {

            var linkUrl = "/admin/haircare/index/getAjax";
            $.ajax({
                type: "POST",
                url: linkUrl,
                dataType: "json",
                data: {
                    id: value
                },
                success: function (data) {
                    let sub = uiRegistry.get('index = sub_id');
                    sub.options(data);
                    if (subSelectedId !== null) {
                        sub.value(subSelectedId);
                    }
                },
                error: function () {
                }
            });
            return this;
        }

    });
});