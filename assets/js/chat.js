document.addEventListener("DOMContentLoaded", () => {
  const listEl = document.getElementById("chat-messages");
  const formEl = document.getElementById("chat-form");
  const nameEl = document.getElementById("chat-name");
  const contentEl = document.getElementById("chat-content");
  const statusEl = document.getElementById("chat-status");

  async function fetchMessages() {
    try {
      const res = await fetch("chat_fetch.php?t=" + Date.now(), {
        cache: "no-store",
      });
      const data = await res.json();
      if (!data.ok) return;
      listEl.innerHTML = "";
      const colors = [
        "#00ffae",
        "#ffcc00",
        "#ff6b6b",
        "#4dabf7",
        "#b197fc",
        "#ffc078",
        "#63e6be",
        "#ffd43b",
        "#74c0fc",
        "#faa2c1",
      ];
      function pickColor(name) {
        let sum = 0;
        for (let i = 0; i < name.length; i++)
          sum = (sum + name.charCodeAt(i)) % 2147483647;
        return colors[sum % colors.length];
      }

      data.messages.forEach((m) => {
        const item = document.createElement("div");
        item.className = "chat-item";
        item.innerHTML = `
          <div class="chat-item-header">
            <span class="chat-item-name">${escapeHtml(m.name)}</span>
            <span class="chat-item-time">${m.created_at}</span>
          </div>
          <div class="chat-item-content">${linkify(escapeHtml(m.content))}</div>
        `;
        listEl.appendChild(item);
        const nameEl = item.querySelector(".chat-item-name");
        nameEl.style.color = pickColor(m.name);
      });
      // Scroll to the newest message at the bottom
      listEl.scrollTop = listEl.scrollHeight;
    } catch (e) {
      // ignore
    }
  }

  function escapeHtml(str) {
    return str
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
  }

  function linkify(text) {
    const urlRegex = /(https?:\/\/[^\s]+)/g;
    return text.replace(
      urlRegex,
      (url) => `<a href="${url}" target="_blank" rel="noopener">${url}</a>`
    );
  }

  formEl.addEventListener("submit", async (e) => {
    e.preventDefault();
    const name = nameEl.value.trim();
    const content = contentEl.value.trim();
    if (!name || !content) {
      statusEl.textContent = "Vui lòng nhập tên và nội dung";
      return;
    }
    statusEl.textContent = "Đang gửi...";
    try {
      const res = await fetch("chat_submit.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({ name, content }).toString(),
      });
      const data = await res.json();
      if (data.ok) {
        contentEl.value = "";
        await fetchMessages();
        listEl.scrollTop = listEl.scrollHeight;
        statusEl.textContent = "Đã gửi!";
        setTimeout(() => (statusEl.textContent = ""), 1200);
      } else {
        statusEl.textContent = data.error || "Lỗi gửi tin nhắn";
      }
    } catch (e) {
      statusEl.textContent = "Lỗi kết nối";
    }
  });

  fetchMessages();
  setInterval(fetchMessages, 10000);
});
