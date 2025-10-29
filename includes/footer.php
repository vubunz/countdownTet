        <footer>
            © 2025 - realBunz | Chúc bạn một năm mới hạnh phúc 💖
        </footer>
        </div>

        <!-- JavaScript (cache-busting) -->
        <?php $js_ver = @filemtime(__DIR__ . '/../assets/js/script.js') ?: time(); ?>
        <script src="assets/js/script.js?v=<?php echo $js_ver; ?>"></script>
        <?php $chat_js_ver = @filemtime(__DIR__ . '/../assets/js/chat.js') ?: time(); ?>
        <script src="assets/js/chat.js?v=<?php echo $chat_js_ver; ?>"></script>

        <?php include __DIR__ . '/background.php'; ?>
        </body>

        </html>