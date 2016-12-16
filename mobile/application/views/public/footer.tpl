<script src="<{''|getBaseUrl}>/static/js/common/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="<{''|getBaseUrl}>/static/js/common/global.js"></script>
<{foreach $jsArr as $js}>
    <script type="text/javascript" src="<{$js['url']|getBaseUrl}>"></script>
<{/foreach}>
