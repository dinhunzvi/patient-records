Hello <b>{{ $_name }}</b>

<p>
    Welcome to Sally Mugabe Central Hospital Patients Management System. Your sign in credentials are as follows:<br />
    Email address: <b>{{ $_email }}</b><br />
    Password: <b>{{ $_password }}</b>
</p>

<p>
    After signing in <a href="http:{{ route( 'login') }}">here</a>, you are advised to change your
    password to a strong password that you can easily remember.
</p>

<p>

    Regards

    Support

</p>
