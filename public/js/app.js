// import './bootstrap';
// import 'https://js.pusher.com/7.0/pusher.min.js';

console.log('pusher 前')

// 初始化 Pusher
const pusher = new Pusher('771599bd4947d3ad7e41', {
    cluster: 'ap1',
    encrypted: true,
    // debug: true,
});

// 订阅订单频道
const channel = pusher.subscribe('create-order-channel');

console.log(channel.bind());

// 监听事件并更新 $orderNew
channel.bind('App\\Events\\NewOrderEvent', function(data) {
    
    // 更新 $orderNew 的值
    const orderNew = data.orderNewCount;

    console.log('進入')
    console.log(data)
    console.log(orderNew);

    // 然后在页面中更新相关的元素
    document.querySelector('#order-new').innerText = orderNew;
});

pusher.connection.bind('error', function(err) {
    console.error(err);
});

console.log(channel.bind());

console.log('pusher 后')