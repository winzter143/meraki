<h1>Welcome</h1>
<div>
    <form action='<?php echo site_url('splash/submit')?>' method='post'>
    <input type="hidden" name="base_grant_url" value='<?php echo $base_grant_url; ?>'/>
    <input type="hidden" name="user_continue_url" value='<?php echo $user_continue_url; ?>'/>
    <label>Name: </label><input type="text" name="name" />
    <label>Mobile: </label><input type="text" name="mobile" />
    <input type="submit" name="submit" />
    </form>
</div>
