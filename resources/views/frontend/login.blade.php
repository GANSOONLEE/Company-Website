<form action="{{ route('login.post') }}" method="POST">
    @csrf
    <!-- 登录表单字段 -->
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Login</button>
</form>
