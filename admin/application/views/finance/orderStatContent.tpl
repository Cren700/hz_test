
<div class="row-fluid" id="orderStat">
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                <h5>支付订单</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>统计项目</th>
                        <th>数据</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>交易人数</td>
                        <td id="js-orderNum"><{$info['resPay']['order_num']}></td>
                    </tr>
                    <tr>
                        <td>金额</td>
                        <td id="js-orderTotal"><{$info['resPay']['order_total']}></td>
                    </tr>
                    <tr>
                        <td>交易笔数</td>
                        <td id="js-orderCount"><{$info['resPay']['order_count']}></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                <h5>提现订单</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>统计项目</th>
                        <th>数据</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>交易人数</td>
                        <td id="js-txNum"><{$info['resTx']['order_num']}></td>
                    </tr>
                    <tr>
                        <td>金额</td>
                        <td id="js-txTotal"><{$info['resTx']['order_total']}></td>
                    </tr>
                    <tr>
                        <td>交易笔数</td>
                        <td id="js-txCount"><{$info['resTx']['order_count']}></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                <h5>理赔订单</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>统计项目</th>
                        <th>数据</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>交易人数</td>
                        <td id="js-claimNum"><{$info['resClaim']['order_num']}></td>
                    </tr>
                    <tr>
                        <td>金额</td>
                        <td id="js-claimTotal"><{$info['resClaim']['order_total']}></td>
                    </tr>
                    <tr>
                        <td>交易笔数</td>
                        <td id="claimCount"><{$info['resClaim']['order_count']}></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>