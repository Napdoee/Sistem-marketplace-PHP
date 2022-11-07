$().ready(function () {
  jQuery("#UserRegister").validate({
    rules: {
      user: "required",
      mail: {
        required: true,
        email: true,
      },
      telp: {
        required: true,
        number: true,
        minlength: 10,
      },
      pass: {
        required: true,
        minlength: 5,
      },
      pass2: {
        required: true,
        minlength: 5,
        equalTo: "#pass",
      },
    },
    messages: {
      user: "Please enter a username!",
      mail: {
        required: "Please enter a email address!",
        email: "Please enter a valid email address",
      },
      telp: {
        required: "Please enter a phone number",
        number: "Please enter a valid phone number",
        minlength: "Phone number must be at least 10 digits",
      },
      pass: {
        required: "Please provide a password",
        minlength: "Password must be 5 chars long",
      },
      pass2: {
        required: "Please enter your password",
        minlength: "Password must be 5 chars long",
        equalTo: "Please enter the same password as above",
      },
    },
  });

  $("#BtnRegister").click(function () {
    $("#UserRegister").valid();
  });
});
