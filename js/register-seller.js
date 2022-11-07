$().ready(function () {
  jQuery("#SellerRegister").validate({
    rules: {
      company: {
        required: true,
        minlength: 5,
      },
      user: "required",
      pass: {
        required: true,
        minlength: 5,
      },
      telp: {
        required: true,
        number: true,
        minlength: 10,
      },
    },
    messages: {
      company: {
        required: "Please enter a company name",
        minlength: "Company name must be at least 5 chars",
      },
      user: "Please enter a username",
      pass: {
        required: "Please enter a password",
        minlength: "Password must be at least 5 chars",
      },
      telp: {
        required: "Please enter a phone number",
        number: "Please enter a valid number phone",
        minlength: "Phone number must be at least 10 digits",
      },
    },
  });
  $("#BtnRegister").click(function () {
    $("#SellerRegister").valid();
  });
});
