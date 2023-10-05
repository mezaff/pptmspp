<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MIDTRANS TEST</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div>
        Order ID <input type="text" id="order_id">
    </div>
    <div>
        Total <input type="text" id="total">
    </div>
    <button id="pay-button">Bayar</button>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        $(document).ready(function() {
            $("#pay-button").click(function(e) {
                var orderId = $("#order_id").val();
                var total = $("#total").val();
                var url = "/payment?order_id=" + orderId + "&total=" + total;
                $.getJSON(url
                    , function(data, textStatus, jqXHR) {
                        snap.pay(data.snapToken);
                    }
                );
            });
        });

    </script>
</body>
</html>
