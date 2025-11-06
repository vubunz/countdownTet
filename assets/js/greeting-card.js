document.addEventListener("DOMContentLoaded", function () {
  const canvas = document.getElementById("greeting-canvas");
  const ctx = canvas.getContext("2d");

  let templateImage = null;
  let userImage1 = null;
  let userImage2 = null;

  // Vị trí và kích thước các khung ảnh (đã điều chỉnh theo mẫu MAU1.png)
  // Lưu ý: x, y là tọa độ góc trên trái của khung ảnh
  let imagePositions = {
    image1: { x: 70, y: 90, size: 360 }, // Góc trên trái (trung tâm ~250, 270)
    image2: { x: 570, y: 870, size: 360 }, // Góc dưới phải (trung tâm ~750, 1050)
  };

  // Vị trí và style cho text (đã điều chỉnh theo mẫu MAU1.png)
  let textPositions = {
    text1: { x: 700, y: 120, fontSize: 45, color: "#ffffff" }, // Dòng chữ 1 (ví dụ: năm)
    text2: { x: 700, y: 200, fontSize: 70, color: "#ffffff" }, // Dòng chữ 2 (ví dụ: tiêu đề)
  };

  // Tính toán vị trí dựa trên kích thước canvas thực tế
  function calculatePositions() {
    if (!templateImage) return;

    const canvasWidth = canvas.width;
    const canvasHeight = canvas.height;

    // Tính toán vị trí theo tỷ lệ (giả sử mẫu gốc là 1000x1500px)
    const scaleX = canvasWidth / 1000;
    const scaleY = canvasHeight / 1500;
    const scale = Math.min(scaleX, scaleY); // Dùng scale nhỏ hơn để giữ tỷ lệ

    // Lưu màu và fontSize hiện tại trước khi tính toán
    const savedColor1 = textPositions.text1
      ? textPositions.text1.color
      : "#ffffff";
    const savedColor2 = textPositions.text2
      ? textPositions.text2.color
      : "#ffffff";
    const savedFontSize1 =
      textPositions.text1 && textPositions.text1.fontSize
        ? textPositions.text1.fontSize
        : 45 * scale;
    const savedFontSize2 =
      textPositions.text2 && textPositions.text2.fontSize
        ? textPositions.text2.fontSize
        : 70 * scale;

    // Cập nhật vị trí ảnh theo tỷ lệ
    imagePositions = {
      image1: {
        x: 70 * scaleX,
        y: 90 * scaleY,
        size: 360 * scale,
      },
      image2: {
        x: 570 * scaleX,
        y: 870 * scaleY,
        size: 360 * scale,
      },
    };

    // Cập nhật vị trí chữ theo tỷ lệ (giữ fontSize nếu đã được user thay đổi)
    textPositions = {
      text1: {
        x: 700 * scaleX,
        y: 120 * scaleY,
        fontSize: savedFontSize1,
        color: savedColor1,
      },
      text2: {
        x: 700 * scaleX,
        y: 200 * scaleY,
        fontSize: savedFontSize2,
        color: savedColor2,
      },
    };
  }

  // Load template image
  const templateImg = new Image();
  templateImg.crossOrigin = "anonymous";
  templateImg.onload = function () {
    templateImage = templateImg;
    // Set canvas size to match template
    canvas.width = templateImg.width;
    canvas.height = templateImg.height;
    // Tính toán lại vị trí dựa trên kích thước thực tế
    calculatePositions();
    renderCard();
  };
  templateImg.src = "assets/template/MAU1.png";

  // Upload Image 1
  const uploadBtn1 = document.getElementById("upload-image-btn-1");
  const imageInput1 = document.getElementById("user-image-1");
  const imagePreview1 = document.getElementById("image-preview-1");
  const removeImageBtn1 = document.getElementById("remove-image-btn-1");

  uploadBtn1.addEventListener("click", () => imageInput1.click());

  imageInput1.addEventListener("change", function (e) {
    const file = e.target.files[0];
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = function (event) {
        const img = new Image();
        img.onload = function () {
          userImage1 = img;
          imagePreview1.innerHTML = `<img src="${event.target.result}" alt="Preview 1" style="max-width: 200px; border-radius: 8px;">`;
          removeImageBtn1.style.display = "inline-block";
          renderCard();
        };
        img.src = event.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  removeImageBtn1.addEventListener("click", function () {
    userImage1 = null;
    imageInput1.value = "";
    imagePreview1.innerHTML = "";
    this.style.display = "none";
    renderCard();
  });

  // Upload Image 2
  const uploadBtn2 = document.getElementById("upload-image-btn-2");
  const imageInput2 = document.getElementById("user-image-2");
  const imagePreview2 = document.getElementById("image-preview-2");
  const removeImageBtn2 = document.getElementById("remove-image-btn-2");

  uploadBtn2.addEventListener("click", () => imageInput2.click());

  imageInput2.addEventListener("change", function (e) {
    const file = e.target.files[0];
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = function (event) {
        const img = new Image();
        img.onload = function () {
          userImage2 = img;
          imagePreview2.innerHTML = `<img src="${event.target.result}" alt="Preview 2" style="max-width: 200px; border-radius: 8px;">`;
          removeImageBtn2.style.display = "inline-block";
          renderCard();
        };
        img.src = event.target.result;
      };
      reader.readAsDataURL(file);
    }
  });

  removeImageBtn2.addEventListener("click", function () {
    userImage2 = null;
    imageInput2.value = "";
    imagePreview2.innerHTML = "";
    this.style.display = "none";
    renderCard();
  });

  // Text 1 controls
  const text1 = document.getElementById("text-1");
  const text1Size = document.getElementById("text-1-size");
  const text1SizeValue = document.getElementById("text-1-size-value");
  const text1Color = document.getElementById("text-1-color");

  text1Size.addEventListener("input", function () {
    text1SizeValue.textContent = this.value;
    // Giữ nguyên fontSize khi user thay đổi
    const baseFontSize = textPositions.text1.fontSize || 45;
    textPositions.text1.fontSize = parseInt(this.value);
    renderCard();
  });

  text1.addEventListener("input", renderCard);
  text1Color.addEventListener("change", function () {
    textPositions.text1.color = this.value;
    renderCard();
  });

  // Text 2 controls
  const text2 = document.getElementById("text-2");
  const text2Size = document.getElementById("text-2-size");
  const text2SizeValue = document.getElementById("text-2-size-value");
  const text2Color = document.getElementById("text-2-color");

  text2Size.addEventListener("input", function () {
    text2SizeValue.textContent = this.value;
    // Giữ nguyên fontSize khi user thay đổi
    const baseFontSize = textPositions.text2.fontSize || 70;
    textPositions.text2.fontSize = parseInt(this.value);
    renderCard();
  });

  text2.addEventListener("input", renderCard);
  text2Color.addEventListener("change", function () {
    textPositions.text2.color = this.value;
    renderCard();
  });

  // Render card function
  function renderCard() {
    if (!templateImage) return;

    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw template background
    ctx.drawImage(templateImage, 0, 0, canvas.width, canvas.height);

    // Draw user image 1 (circular, top left)
    if (userImage1) {
      const pos1 = imagePositions.image1;
      ctx.save();
      ctx.beginPath();
      ctx.arc(
        pos1.x + pos1.size / 2,
        pos1.y + pos1.size / 2,
        pos1.size / 2,
        0,
        Math.PI * 2
      );
      ctx.clip();
      ctx.drawImage(userImage1, pos1.x, pos1.y, pos1.size, pos1.size);
      ctx.restore();

      // Optional: draw border
      ctx.strokeStyle = "#ffffff";
      ctx.lineWidth = 4;
      ctx.beginPath();
      ctx.arc(
        pos1.x + pos1.size / 2,
        pos1.y + pos1.size / 2,
        pos1.size / 2,
        0,
        Math.PI * 2
      );
      ctx.stroke();
    }

    // Draw user image 2 (circular, bottom right)
    if (userImage2) {
      const pos2 = imagePositions.image2;
      ctx.save();
      ctx.beginPath();
      ctx.arc(
        pos2.x + pos2.size / 2,
        pos2.y + pos2.size / 2,
        pos2.size / 2,
        0,
        Math.PI * 2
      );
      ctx.clip();
      ctx.drawImage(userImage2, pos2.x, pos2.y, pos2.size, pos2.size);
      ctx.restore();

      // Optional: draw border
      ctx.strokeStyle = "#ffffff";
      ctx.lineWidth = 4;
      ctx.beginPath();
      ctx.arc(
        pos2.x + pos2.size / 2,
        pos2.y + pos2.size / 2,
        pos2.size / 2,
        0,
        Math.PI * 2
      );
      ctx.stroke();
    }

    // Draw text 1
    const text1Value = text1.value || "";
    if (text1Value) {
      ctx.font = `bold ${textPositions.text1.fontSize}px Poppins, Arial, sans-serif`;
      ctx.fillStyle = textPositions.text1.color;
      ctx.textAlign = "center";
      ctx.textBaseline = "middle";

      // Text shadow for better visibility
      ctx.shadowColor = "rgba(0, 0, 0, 0.7)";
      ctx.shadowBlur = 6;
      ctx.shadowOffsetX = 2;
      ctx.shadowOffsetY = 2;

      ctx.fillText(text1Value, textPositions.text1.x, textPositions.text1.y);

      ctx.shadowBlur = 0;
      ctx.shadowOffsetX = 0;
      ctx.shadowOffsetY = 0;
    }

    // Draw text 2 (with text wrapping)
    const text2Value = text2.value || "";
    if (text2Value) {
      ctx.font = `bold ${textPositions.text2.fontSize}px Poppins, Arial, sans-serif`;
      ctx.fillStyle = textPositions.text2.color;
      ctx.textAlign = "center";
      ctx.textBaseline = "middle";

      // Text shadow
      ctx.shadowColor = "rgba(0, 0, 0, 0.7)";
      ctx.shadowBlur = 6;
      ctx.shadowOffsetX = 2;
      ctx.shadowOffsetY = 2;

      // Wrap text
      const maxWidth = canvas.width - 100;
      const lines = wrapText(ctx, text2Value, maxWidth);
      const lineHeight = textPositions.text2.fontSize * 1.4;
      const startY =
        textPositions.text2.y - ((lines.length - 1) * lineHeight) / 2;

      lines.forEach((line, index) => {
        const y = startY + index * lineHeight;
        ctx.fillText(line, textPositions.text2.x, y);
      });

      ctx.shadowBlur = 0;
      ctx.shadowOffsetX = 0;
      ctx.shadowOffsetY = 0;
    }
  }

  function wrapText(context, text, maxWidth) {
    const words = text.split(" ");
    const lines = [];
    let currentLine = words[0] || "";

    for (let i = 1; i < words.length; i++) {
      const word = words[i];
      const width = context.measureText(currentLine + " " + word).width;
      if (width < maxWidth) {
        currentLine += " " + word;
      } else {
        if (currentLine) lines.push(currentLine);
        currentLine = word;
      }
    }
    if (currentLine) lines.push(currentLine);
    return lines;
  }

  // Download button
  const downloadBtn = document.getElementById("download-btn");
  downloadBtn.addEventListener("click", function () {
    const link = document.createElement("a");
    link.download = `thiep-chuc-tet-2026-${Date.now()}.png`;
    link.href = canvas.toDataURL("image/png");
    link.click();
  });

  // Reset button
  const resetBtn = document.getElementById("reset-btn");
  resetBtn.addEventListener("click", function () {
    // Reset images
    userImage1 = null;
    userImage2 = null;
    imageInput1.value = "";
    imageInput2.value = "";
    imagePreview1.innerHTML = "";
    imagePreview2.innerHTML = "";
    removeImageBtn1.style.display = "none";
    removeImageBtn2.style.display = "none";

    // Reset text 1
    text1.value = "2026";
    text1Size.value = 45;
    text1SizeValue.textContent = "45";
    text1Color.value = "#ffffff";
    calculatePositions(); // Recalculate positions
    textPositions.text1.fontSize = 45;
    textPositions.text1.color = "#ffffff";

    // Reset text 2
    text2.value = "Chúc mừng năm mới 2026! 🎉";
    text2Size.value = 70;
    text2SizeValue.textContent = "70";
    text2Color.value = "#ffffff";
    calculatePositions(); // Recalculate positions
    textPositions.text2.fontSize = 70;
    textPositions.text2.color = "#ffffff";

    renderCard();
  });
});
