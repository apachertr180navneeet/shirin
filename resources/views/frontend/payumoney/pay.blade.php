<!DOCTYPE html>
<html>
<head>
    <title>{{ translate('Redirecting to PayU...') }}</title>
</head>
<body>
    <form id="payu_form" action="{{ $payu_url }}" method="post">
        <input type="hidden" name="key" value="{{ $merchant_key }}">
        <input type="hidden" name="txnid" value="{{ $txnid }}">
        <input type="hidden" name="amount" value="{{ sprintf('%.2f', $amount) }}">
        <input type="hidden" name="productinfo" value="{{ $productinfo }}">
        <input type="hidden" name="firstname" value="{{ $firstname }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="phone" value="{{ $phone }}">
        <input type="hidden" name="surl" value="{{ route('payumoney.success') }}">
        <input type="hidden" name="furl" value="{{ route('payumoney.cancel') }}">
        <input type="hidden" name="hash" value="{{ $hash }}">
        <p>{{ translate('Redirecting to PayU...') }}</p>
        <button type="submit">{{ translate('Click here if not redirected') }}</button>
    </form>
    <script>
        document.getElementById('payu_form').submit();
    </script>
</body>
</html>
