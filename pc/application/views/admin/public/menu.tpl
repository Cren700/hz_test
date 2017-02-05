
<div id="sidebar">
    <ul>
        <{foreach $menu as $m}>
        <li class="<{if isset($m['sub'])}> submenu <{/if}><{if $m['selected']}> open <{/if}>"> <a href="#"><i class="icon <{$m['icon']|default:'icon-bar-chart'}>"></i> <span><{$m['name']}></span></a>
            <ul>
                <{foreach $m['sub'] as $s}>
                <li<{if $s['selected']}> class="active" <{/if}> ><a href="<{'/'|cat:$m['flagName']|cat:'/'|cat:$s['flagName']|cat:'.html'|getBaseUrl}>"><{$s['name']}></a></li>
                <{/foreach}>
            </ul>
        </li>
        <{/foreach}>
    </ul>
</div>