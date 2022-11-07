$().ready(function () {
  jQuery("#ChangePassword").validate({
    rules: {
      pass: "required",
      pass1: {
        required: true,
        minlength: 5,
      },
      pass2: {
        required: true,
        minlength: 5,
        equalTo: "#pass1",
      },
    },
    messages: {
      pass: "Please enter your previous password",
      pass1: {
        required: "Please enter your new password",
        minlength: "Password must be at least 5 chars long",
      },
      pass2: {
        required: "Please enter your password",
        minlength: "Password must be at least 5 chars long",
        equalTo: "Please enter the same password as above",
      },
    },
  });
  $("#BtnSubmit").click(function () {
    $("#ChangePassword").valid();
  });
});
