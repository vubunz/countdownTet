<?php
?>
<div class="modal fade" id="modalForgotPass" tabindex="-1" aria-labelledby="modalForgotPassLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalForgotPassLabel">Quên mật khẩu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <form id="forgotPassForm">
                    <div class="mb-3">
                        <label for="forgotUsername" class="form-label">Nhập tên đăng nhập đã đăng ký</label>
                        <input type="text" class="form-control" id="forgotUsername" name="forgotUsername" placeholder="Nhập tên đăng nhập của bạn" required>
                        <div class="invalid-feedback">Vui lòng nhập tên đăng nhập hợp lệ.</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Gửi lại mật khẩu</button>
                </form>
                <div id="forgotPassMsg" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#forgotPassForm').on('submit', function(e) {
            e.preventDefault();
            var username = $('#forgotUsername').val().trim();
            var msgBox = $('#forgotPassMsg');
            msgBox.html('');
            if (username.length === 0) {
                $('#forgotUsername').addClass('is-invalid');
                return;
            } else {
                $('#forgotUsername').removeClass('is-invalid');
            }
            msgBox.html('<div class="text-info">Đang xử lý...</div>');
            $.ajax({
                url: 'post-forgot.php',
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify({
                    username: username
                }),
                success: function(res) {
                    if (res.code === '00') {
                        msgBox.html('<div class="alert alert-success">' + res.text + '</div>');
                    } else {
                        msgBox.html('<div class="alert alert-danger">' + res.text + '</div>');
                    }
                },
                error: function() {
                    msgBox.html('<div class="alert alert-danger">Có lỗi xảy ra, vui lòng thử lại sau.</div>');
                }
            });
        });
    });
</script>