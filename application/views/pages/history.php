<div id="header-featured">
    <center>
    <h2>History:</h2>
    <form method="POST" name="stock-form">
    <select id="stock-select" name="DropDownBox">
        <option value="BOND">Bond</option>
        <option value="GOLD">Gold</option>
        <option value="GRAN">Grain</option>
        <option value="IND">Industrial</option>
        <option vlaue="OIL">Oil</option>
        <option value="TECH">Tech</option>
    </select>
        <input type="submit" value="Submit" name="BTN">
    </form>
        <table class="table">
            <tr>
                <th>Buy/Sell</th>
                <th>Amount of Stocks</th>
                <th>Date/Time</th>
            </tr>
            {content}
        </table>
    </center>
</div>