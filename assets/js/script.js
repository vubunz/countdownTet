// Countdown Timer for Tết 2026
document.addEventListener("DOMContentLoaded", function () {
  const countdown = document.getElementById("countdown");
  const elDays = document.getElementById("count-days");
  const elHours = document.getElementById("count-hours");
  const elMinutes = document.getElementById("count-minutes");
  const elSeconds = document.getElementById("count-seconds");
  const tet = new Date("Feb 17, 2026 00:00:00").getTime();

  // Add loading class initially (if legacy countdown exists)
  if (countdown) countdown.classList.add("loading");

  function updateCountdown() {
    const now = new Date().getTime();
    const distance = tet - now;

    if (distance <= 0) {
      if (countdown) {
        countdown.innerHTML =
          "🎉 Chúc mừng năm mới 2026! Chúc bạn một năm an khang, thịnh vượng! 🎊";
        document.title = "Chúc mừng năm mới 2026 🎆";
        countdown.classList.remove("loading");
      }
      if (elDays) elDays.textContent = "0";
      if (elHours) elHours.textContent = "00";
      if (elMinutes) elMinutes.textContent = "00";
      if (elSeconds) elSeconds.textContent = "00";
      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
    );
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

    if (countdown) {
      countdown.innerHTML = `Còn ${days} ngày, ${hours} giờ, ${minutes} phút, ${seconds} giây nữa là đến Giao Thừa!`;
      countdown.classList.remove("loading");
    }
    if (elDays) elDays.textContent = String(days);
    if (elHours) elHours.textContent = String(hours).padStart(2, "0");
    if (elMinutes) elMinutes.textContent = String(minutes).padStart(2, "0");
    if (elSeconds) elSeconds.textContent = String(seconds).padStart(2, "0");
  }

  // Update immediately
  updateCountdown();

  // Update every second
  setInterval(updateCountdown, 1000);
});

// Service Worker for PWA (optional)
if ("serviceWorker" in navigator) {
  window.addEventListener("load", function () {
    navigator.serviceWorker
      .register("/sw.js")
      .then(function (registration) {
        console.log("SW registered: ", registration);
      })
      .catch(function (registrationError) {
        console.log("SW registration failed: ", registrationError);
      });
  });
}
