<{if isset($info['list'])}>
<{assign var=i value="1"}>
<{foreach $info['list'] as $l}>
<li>
    <span class="data_td"><i class="js-e"><{($i++)+($p-1)*10}>.</i><{$l.Fpartners_name}></span>
    <span class="data_tt"><{$l.Fnum}></span>
</li>
<{/foreach}>
<{/if}>