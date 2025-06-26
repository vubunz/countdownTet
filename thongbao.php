<?php
// thongbao.php
?>
<div class="alert alert-warning py-2 my-2 text-center" role="alert" style="overflow:hidden; white-space:nowrap; border-radius: 8px; font-weight: 500; font-size: 1.1rem;">
    <div class="marquee">
        <span>
            🔔 Thông báo: Chào mừng bạn đến với Ninja Legacy! Đăng ký tài khoản để nhận nhiều phần quà hấp dẫn. Chúc bạn chơi game vui vẻ! 🔔
        </span>
    </div>
</div>
<style>
    .marquee {
        display: block;
        width: 100%;
        overflow: hidden;
        position: relative;
        height: 1.5em;
        will-change: transform;
    }

    .marquee span {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 15s linear infinite;
        white-space: nowrap;
    }

    @keyframes marquee {
        0% {
            transform: translateX(0);
        }

        100% {
            transform: translateX(-100%);
        }
    }
</style>