<div class="row">
<div class="col-md-12">
<form action="/admin/update/{id}" method="post">
    <label>Name</label>
    <input type="text" name="name" value="{name}"></input>
    <br/>
    <label>ID - READONLY</label>
    <input type="text" name="id" value="{id}" readonly></input>
    <br/>
    <label>Role</label>
    <select name="role">
        <option value="user">user</option>
        <option value="admin">admin</option>
    </select>
    <br/>
    <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
</div>
