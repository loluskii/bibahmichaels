
    paypal.Buttons({
        createOrder: function(data, actions) {
        // This function sets up the details of the transaction, including the amount and line item details.
        return actions.order.create({
            application_context: {
                brand_name : 'Bibah Michael',
                user_action : 'PAY_NOW',
            },
            purchase_units: [{
                amount: {
                    currency_code: "{{ $currency }}",
                    value: '{{ number_format(App\Helpers\Helper::currency_converter(Cart::session(App\Helpers\Helper::getSessionID())->getTotal()), 2) }}'
                },
                description: "Order from Bibah Michael",
            }],
        });
        },

        onApprove: function(data, actions) {

            let token = '{{ csrf_token() }}'

            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                if(details.status == 'COMPLETED'){
                return fetch('/paypal/order/store', {
                            method: 'post',
                            headers: {
                                'content-type': 'application/json',
                                "Accept": "application/json, text-plain, */*",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-TOKEN": token
                            },
                            body: JSON.stringify({
                                orderId: details.id,
                                amount: details.purchase_units[0].amount.value,
                                subamount: @json( \Cart::session(App\Helpers\Helper::getSessionID())->getSubTotal()),
                                user_id: @json(Auth::user()->id ?? rand(0000,9999)),
                                currency: details.purchase_units[0].amount.currency_code,
                                id : details.id,
                                payment_id: details.purchase_units[0].payments.captures[0].id
                            })
                        })
                        .then(function (a) {
                            return a.json(); // call the json method on the response to get JSON
                        })
                        .then(function (json) {
                            let ref = json.ref;
                            console.log(json.ref)
                            window.location.href = '/orders/'+json.ref
                        })
                        .catch(function(error) {
                            return error;
                        });
                }else{
                    window.location.href = '/pay-failed?reason=failedToCapture';
                }
            });
        },
        onCancel: function (data) {
            let session = "{{ session()->get('session') }}"
            window.location.href = '/checkout/3/'+session;
        }
    }).render('#paypal-button-container');
    // This function displays Smart Payment Buttons on your web page.

    function status(res) {
      if (!res.ok) {
          throw new Error(res.statusText);
      }
      return res;
    }
