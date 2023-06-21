<style>
    #alert {
        position: absolute;
        top: -6vh;
        left: 1.4vw;
        width: 80vw;
        height: 6vh;
        margin: 0;
        z-index: 9999; /* 确保在最上层 */
        transition: transform 0.5s ease-out; /* 添加动画过渡效果 */
    }

    .show {
        transform: translateY(8vh); /* 向下移动元素 */
    }

    .hide {
        transform: translateY(-6vh); /* 向上移动元素 */
    }
</style>

<div id="alert" class="alert alert-{!! $alertType !!} alert-dismissible" role="alert">
    {!! $message !!}
</div>

<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const alertElement = document.getElementById('alert');
        const fadeInSeconds = 0; // 延迟透明度渐显的时间（单位：秒）
        const delayInSeconds = 5; // 停留的时间（单位：秒）

        setTimeout(() => {
            alertElement.classList.add('show');
        }, fadeInSeconds * 1000); // 将延迟时间转换为毫秒

        setTimeout(() => {
            alertElement.classList.add('hide');
        }, (fadeInSeconds + delayInSeconds) * 1000); // 将延迟时间转换为毫秒
    });
</script>
