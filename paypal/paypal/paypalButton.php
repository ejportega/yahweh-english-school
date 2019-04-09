<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<div id="paypal-button"></div>
  
<script>
  paypal.Button.render({
    // get payments values

    <?php if(PRO_PayPal) { ?>
      env: 'production', // Or 'sandbox',
    <?php } else { ?>
      env: 'sandbox',
    <?php } ?>

    client: {
      sandbox: '<?php echo PayPal_CLIENT_ID ?>',
      production: '<?php echo PayPal_CLIENT_ID ?>'
    },
    
    commit: true, // Show a 'Pay Now' button

    style: {
      color: 'gold',
      size: 'medium',
      label: 'pay'
    },
    
    // payment() is called when the button is clicked
    payment: function(data, actions) {
      // Make a call to the REST API to create the payment
      return actions.payment.create({
        payment: {
          transactions: [
            {
                amount: { 
                  total: $("input[name=amount]").val(), 
                  currency: '<?php echo "USD" ?>' 
                }
            }
          ]
        }
      });
    },

    // called when the buyer approces the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function(payment) {
        // The payment is complete!
        // You can now show a confirmation message to the customer
         window.location = "<?php echo BASE_URL ?>payment-process.php?paymentID="+data.paymentID+"&payerID="+data.payerID+"&token="+data.paymentToken+"&session_count="+$("input[name=session_count]").val()+"&amount="+$("input[name=amount]").val();
      });
    },

    onCancel: function(data, actions) {
      /* 
        * Buyer cancelled the payment 
        */
    },

    onError: function(err) {
      /* 
        * An error occurred during the transaction 
        */
    }
  }, '#paypal-button');
</script>