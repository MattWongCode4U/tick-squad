<div id="header-featured">
    <h2>History:</h2>
        <table class="table">
            <tr>
                <th>Buy/Sell</th>
                <th>Amount of Stocks</th>
                <th>Date/Time</th>
            </tr>
            {transactions}
            <tr>
                <td>{Trans}</td>
                <td>{Quantity}</td>
                <td>{DateTime}</td>
            </tr>
            {/transactions}
        </table>
    <div id="banner-wrapper">
        <div id="banner" class="container">
            <h2><? echo $title; ?></h2>
			
        </div>
    </div>
</div>