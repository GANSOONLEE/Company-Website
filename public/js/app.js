
// 初始化 Pusher
const pusher = new Pusher('771599bd4947d3ad7e41', {
    cluster: 'ap1',
    encrypted: true,
    // debug: true,
});

/**
 *  更新新訂單數
 */

// 订阅订单频道
const channel = pusher.subscribe('create-order-channel');

// 监听事件并更新 $orderNew
channel.bind('App\\Events\\NewOrderEvent', function(data) {
    
    // 更新 $orderNew 的值
    const orderNew = data.orderNewCount;

    // 然后在页面中更新相关的元素

    const container = document.querySelector('.notification-order');
    container.setAttribute('data-number', orderNew)

    const display = container.querySelector('#order-new');
    display.innerText = orderNew;

});

pusher.connection.bind('error', function(err) {
    console.error(err);
});