<script type="text/javascript">
    function replaceUrlParam(url, paramName, paramValue) {
        if (paramValue == null)
            paramValue = '';
        var pattern = new RegExp('\\b(' + paramName + '=).*?(&|$)')
        if (url.search(pattern) >= 0) {
            return url.replace(pattern, '$1' + paramValue + '$2');
        }
        return url + (url.indexOf('?') > 0 ? '&' : '?') + paramName + '=' + paramValue
    }
    $(document).ready(function () {
        var pagingCurrent = '{{Request::get("numpaging")}}';
        $("#selectNumpaging").change(function () {
            var newUrl = replaceUrlParam(location.href, 'numpaging', $(this).val());
            window.location.href = newUrl;
        });
    });
</script>
