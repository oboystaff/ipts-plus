/**
 * Created by degre on 2/10/2021.
 */
/**
 * Created by degre on 1/25/2021.
 */
/**
 * Created by degre on 1/25/2021.
 */
/**
 * Created by degre on 1/18/2021.
 */

var PROP = function () {
    var vldModal = $("#validate-modal")
    var vldForm = $("#validate-form");
    return {
        init: function () {
            PROP.validateForm();

            $(document).on('click', '#btn-vld-action', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
               PROP.validateAction();
            });
            $(document).on('click', '.btn-validate', function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                PROP.resetForm();
                vldModal.modal('show');
            });
        },
        resetForm: function () {
            $("#typeId").val('').trigger('change');
            $("#validmsg").val('');
        },
        validateAction: function () {
            var ajaxOptions = {
                type: "POST",
                url: vldForm.attr('data-action'),
                // contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                data: vldForm.serialize(),
                beforeSend: function (formData, jqForm, options) {
                    if (vldForm.valid()) {
                        Common.showSpinner(vldModal, "Saving...");
                        return true;
                    }
                    return false;
                }
            };
            $.ajax(ajaxOptions).done(function (response) {
                Common.hideSpinner(vldModal);
                if (response.status === "ok") {
                    Common.showMessage(response.msg);
                    PROP.resetForm();
                } else {
                    Common.onError(response.msg);
                }
            }).always(function (xhr) {
                Common.hideSpinner(vldModal);
            }).fail(function (xhr, textStatus, error) {
                Common.hideSpinner(vldModal);
                if (textStatus !== "canceled") {
                    Common.onError("Sorry An Error Occured Whiles Processing The Request. Kindly Try Again Later.");
                }
            });
        },
        validateForm: function () {
            Common.validateForm(vldForm, {
                "idList[]": {
                    required: true
                },
                typeId: "required",
                validmsg: "required"
            }, {
                "idList[]": "Please select properties before you continue",
            });
        },



    };
}();
$(function () {
    PROP.init();
});