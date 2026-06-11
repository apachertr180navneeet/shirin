<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to PayU...</title>
</head>
<body>
    <form id="payu_form" action="{{ $payu_url }}" method="post" accept-charset="UTF-8">
        <input type="hidden" name="key" value="{{ $merchant_key }}">
        <input type="hidden" name="txnid" value="{{ $txnid }}">
        <input type="hidden" name="amount" value="{{ $amount_formatted }}">
        <input type="hidden" name="productinfo" value="{{ $productinfo }}">
        <input type="hidden" name="firstname" value="{{ $firstname }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="phone" value="{{ $phone }}">
        <input type="hidden" name="surl" value="{{ $surl }}">
        <input type="hidden" name="furl" value="{{ $furl }}">
        <input type="hidden" name="hash" value="{{ $hash }}">
        <input type="hidden" name="udf1" value="">
        <input type="hidden" name="udf2" value="">
        <input type="hidden" name="udf3" value="">
        <input type="hidden" name="udf4" value="">
        <input type="hidden" name="udf5" value="">
        <p>Redirecting to PayU...</p>
        <noscript>
            <button type="submit">Click here if not redirected</button>
        </noscript>
    </form>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            var f = document.getElementById('payu_form');
            if (f) {
                var k = f.querySelector('input[name="key"]');
                console.log('key value:', k ? k.value : 'not found');
                console.log('form fields:', f.querySelectorAll('input').length);
                f.submit();
            }
        });
    </script>
</body>
</html>
