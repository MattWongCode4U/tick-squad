<center>
<form method="post" action="/auth/register">
    <fieldset>
        <legend>Register - Admin</legend>
        <label>Name</label>
        <input type="text" id="name" name="name" placeholder="Name" autofocus>
        <br/>
        <label>Username</label>
        <input type="text" id="userid" name="userid" placeholder="Username">
        <br/>
        <label>Password</label>
        <input type="password" id="password" name="password" placeholder="******">
        <br/>
        <label>Role</label>
        <select id="role" name="role">
            <option value="user">user</option>
            <option value="admin">admin</option>
        </select>
        <br/>
        <button type="submit" class="btn btn-default">Submit</button>
    </fieldset>
</form>
</center>
