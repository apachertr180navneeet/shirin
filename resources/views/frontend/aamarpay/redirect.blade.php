<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Redirecting to Aamarpay...</title>
</head>
<body onload="document.forms['redirectpost'].submit();">
    <form name="redirectpost" method="post" action="{{ $base_url }}{{ $url }}">
    </form>
</body>
</html>
