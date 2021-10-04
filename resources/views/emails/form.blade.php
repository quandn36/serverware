<!--
mail send password
developed by ngoc quan
-->
<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:70%;padding:20px 0">
    <div style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">Welcome to Server Warehouse</a>
    </div>
    <p style="font-size:1.1em">Hi, {{ $data['name'] }}</p>
    <p>Thank you for choosing us.  This is the password to access your <strong>{{ $data['email'] }}</strong> account and remember to change your password to ensure your account is secure.</p>
    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">{{ $data['password'] }}</h2>
    <p style="font-size:0.9em;">Regards,<br />Server Warehouse</p>
    <hr style="border:none;border-top:1px solid #eee" />
    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
      <p>Server Warehouse Inc</p>
    </div>
  </div>
</div>
