<form method="post" action="/user/buysell">
    Stocks:
    <select name="bond">
        {selectdata}
    </select>
    <br/>
    <br/>
    Amount:
    <select name="amount">
        <option value="5">5</option>
        <option value="10">10</option>
        <option value="20">20</option>
        <option value="50">50</option>
    </select>
    <br/>
    <br/>
    <input type="submit" class="btn btn-primary" value="Buy"/>
    <input type="submit" class="btn btn-danger" value="Sell"/>
</form>