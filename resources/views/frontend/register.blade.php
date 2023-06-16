<form action="{{ route('register.post') }}" method="POST">
    @csrf
    <!-- 注册表单字段 -->
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="phone" placeholder="Phone">
    <input type="email" name="email" placeholder="Email">
    <input type="date" name="birthday" placeholder="Birthday">
    <input type="text" name="address" placeholder="Address">
    <input type="text" name="occupation" placeholder="Occupation">
    <input type="text" name="store_name" placeholder="Store Name">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Register</button>
</form>
