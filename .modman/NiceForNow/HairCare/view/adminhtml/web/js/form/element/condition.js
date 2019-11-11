/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'Magento_Ui/js/form/element/select'
], function (Select) {
    'use strict';

    return Select.extend({
        defaults: {
            subOptions: null,
            subElems: 'sub_id'
        },
        initialize: function () {
            this.getAjaxSub();
            return this._super();
        },
        getAjaxSub: function () {

            jQuery.ajax({
                url: "/rest/V1/haircare/post/",
                type: "post",
                data: {
                    id: 1,
                },
                success: function (data) {
                    console.log(data);
                },
                error: function () {
                    console.log("23123");
                }
            })
        },


    });
});
