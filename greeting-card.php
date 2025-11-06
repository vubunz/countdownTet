<?php include 'includes/header.php'; ?>
<div class="content">
    <div class="greeting-card-container">
        <h1>🎨 Tạo Thiệp Chúc Tết 2026</h1>
        <p class="greeting-subtitle">Thêm ảnh và lời chúc của bạn vào mẫu thiệp, sau đó tải về!</p>

        <div class="greeting-editor">
            <div class="greeting-left-panel">
                <!-- Upload Ảnh 1 -->
                <div class="greeting-section">
                    <h3>1. Ảnh 1 (Góc trên trái)</h3>
                    <input type="file" id="user-image-1" accept="image/*" style="display: none;">
                    <button type="button" id="upload-image-btn-1" class="btn-secondary">📷 Chọn Ảnh 1</button>
                    <div id="image-preview-1" class="image-preview"></div>
                    <button type="button" id="remove-image-btn-1" class="btn-danger" style="display: none;">🗑️ Xóa Ảnh 1</button>
                </div>

                <!-- Upload Ảnh 2 -->
                <div class="greeting-section">
                    <h3>2. Ảnh 2 (Góc dưới phải)</h3>
                    <input type="file" id="user-image-2" accept="image/*" style="display: none;">
                    <button type="button" id="upload-image-btn-2" class="btn-secondary">📷 Chọn Ảnh 2</button>
                    <div id="image-preview-2" class="image-preview"></div>
                    <button type="button" id="remove-image-btn-2" class="btn-danger" style="display: none;">🗑️ Xóa Ảnh 2</button>
                </div>

                <!-- Nhập Dòng Chữ 1 -->
                <div class="greeting-section">
                    <h3>3. Dòng Chữ 1</h3>
                    <input type="text" id="text-1" placeholder="Nhập dòng chữ 1..." value="2026" class="text-input">
                    <div class="text-controls">
                        <div class="control-group">
                            <label>Kích thước: <span id="text-1-size-value">45</span>px</label>
                            <input type="range" id="text-1-size" min="20" max="100" value="45">
                        </div>
                        <div class="control-group">
                            <label>Màu chữ:</label>
                            <input type="color" id="text-1-color" value="#ffffff">
                        </div>
                    </div>
                </div>

                <!-- Nhập Dòng Chữ 2 -->
                <div class="greeting-section">
                    <h3>4. Dòng Chữ 2</h3>
                    <textarea id="text-2" placeholder="Nhập dòng chữ 2..." rows="3" class="text-input">Chúc mừng năm mới 2026! 🎉</textarea>
                    <div class="text-controls">
                        <div class="control-group">
                            <label>Kích thước: <span id="text-2-size-value">70</span>px</label>
                            <input type="range" id="text-2-size" min="20" max="120" value="70">
                        </div>
                        <div class="control-group">
                            <label>Màu chữ:</label>
                            <input type="color" id="text-2-color" value="#ffffff">
                        </div>
                    </div>
                </div>
            </div>

            <div class="greeting-right-panel">
                <div class="greeting-preview-section">
                    <h3>Xem Trước</h3>
                    <div class="canvas-container">
                        <canvas id="greeting-canvas"></canvas>
                    </div>
                    <div class="preview-actions">
                        <button type="button" id="download-btn" class="btn-download">⬇️ Tải Về</button>
                        <button type="button" id="reset-btn" class="btn-secondary">🔄 Đặt Lại</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- JavaScript for Greeting Card -->
<?php $greeting_js_ver = @filemtime('assets/js/greeting-card.js') ?: time(); ?>
<script src="assets/js/greeting-card.js?v=<?php echo $greeting_js_ver; ?>"></script>