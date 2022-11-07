<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
  // Handle onchange event for input number
  $('.qty').on('input', function() {

    $qty_total = 0;
    // Calculate total qty
    $(".qty").each(function() {
      $qty_total += parseInt($(this).val());
    });

    // Update to Qty input
    $("#qty_total").val($qty_total);

    // Update to Price input
    $("#price_total").val($qty_total * 20);
  })
})
</script>
<div>
  <table>
    <tr>
      <td>Item A</td>
      <td><input value=1 type="number" id="qty1" class="qty"></td>
    </tr>
    <tr>
      <td>Item B</td>
      <td><input value=2 type="number" id="qty2" class="qty"></td>
    </tr>
    <tr>
      <td>Item C</td>
      <td><input value=3 type="number" id="qty3" class="qty"></td>
    </tr>
    <tr>
      <td>Item D</td>
      <td><input value=4 type="number" id="qty4" class="qty"></td>
    </tr>
    <tr>
      <td>Item E</td>
      <td><input value=5 type="number" id="qty5" class="qty"></td>
    </tr>
    <tr>
      <td>Total Qty</td>
      <td><input id="qty_total"></td>
    </tr>
    <tr>
      <td>Total Price</td>
      <td><input id="price_total"></td>
    </tr>
  </table>
</div>