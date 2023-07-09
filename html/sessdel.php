<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function(event) {

        setTimeout(() => {
            localStorage.clear();
            sessionStorage.clear();
            (function() {
                var cookies = document.cookie.split("; ");
                for (var c = 0; c < cookies.length; c++) {
                    var d = window.location.hostname.split(".");
                    while (d.length > 0) {
                        var cookieBase = encodeURIComponent(cookies[c].split(";")[0].split("=")[
                            0]) + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT; domain=' + d.join(
                            '.') + ' ;path=';
                        var p = location.pathname.split('/');
                        document.cookie = cookieBase + '/';
                        while (p.length > 0) {
                            document.cookie = cookieBase + p.join('/');
                            p.pop();
                        };
                        d.shift();
                    }
                }
            })();
            location.href = "index.php";
        }, 1000);
    });
    </script>
</head>

<body>

</body>

</html>