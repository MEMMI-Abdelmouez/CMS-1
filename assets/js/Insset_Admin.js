jQuery(document).ready(function () {
  jQuery("#insset_param_update .button-primary").click(function (e) {
    e.stopPropagation();
    e.preventDefault();

    var formData = new FormData();
    formData.append("action", "insset_admin_function");
    formData.append("security", inssetjs.security);

    jQuery("#insset_param_update")
      .find("input, select, textarea")
      .each(function () {
        var id = jQuery(this).attr("id");
        if (typeof id !== "undefined") {
          formData.append(id, jQuery(this).val());
        }
      });

    jQuery.ajax({
      url: inssetjs.ajax_url,
      xhrFields: {
        withCredentials: true,
      },
      cache: false,
      contentType: false,
      processData: false,
      data: formData,
      type: "post",
      success: function (rs, textStatus, jqXHR) {
        jQuery(".update-message").removeClass("hide");

        return false;
      },
    });
    return false;
  });
});
