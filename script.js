// Lấy ngày yêu
const startDate = new Date('2024-10-01'); // Thay đổi ngày yêu của bạn tại đây
const today = new Date();
// Tính số ngày đã yêu
const timeDifference = today - startDate;
const daysCount = Math.floor(timeDifference / (1000 * 60 * 60 * 24)); // Tính số ngày
// Hiển thị kết quả
document.getElementById('daysCount').textContent = daysCount;
// Hiển thị ngày yêu
document.getElementById('date').textContent = startDate.toLocaleDateString('vi-VN');
// Phát nhạc tự động khi tải trang
const bgMusic = document.getElementById('bg-music');
bgMusic.play();