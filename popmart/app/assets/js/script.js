
    let currentIndex = 0;
    const slides = document.querySelectorAll('.banner-slide');
    const totalSlides = slides.length;
    
    // Hàm chuyển slide tự động
    function autoSlide() {
        // Ẩn slide hiện tại
        slides[currentIndex].style.display = "none";
    
        // Cập nhật chỉ mục của slide
        currentIndex = (currentIndex + 1) % totalSlides;
    
        // Hiển thị slide tiếp theo
        slides[currentIndex].style.display = "block";
    }
    
    // Hàm thay đổi slide khi nhấn nút
    function changeSlide(direction) {
        // Ẩn slide hiện tại
        slides[currentIndex].style.display = "none";
    
        // Cập nhật chỉ mục của slide dựa trên hướng (1 hoặc -1)
        currentIndex = (currentIndex + direction + totalSlides) % totalSlides;
    
        // Hiển thị slide tiếp theo
        slides[currentIndex].style.display = "block";
    }
    
    // Hàm khởi tạo ban đầu
    function initSlider() {
        slides.forEach(slide => slide.style.display = "none");  // Ẩn tất cả các slide
        slides[currentIndex].style.display = "block";  // Hiển thị slide đầu tiên
    
        // Chạy slide tự động mỗi 3 giây (3000 ms)
        setInterval(autoSlide, 3000);
    }
    
    // Gọi hàm khởi tạo khi trang tải
    window.onload = initSlider;
    
    
//detai;
document.getElementById('decreaseQty').addEventListener('click', function () {
  const qtyInput = document.getElementById('quantity');
  let value = parseInt(qtyInput.value, 10);
  if (value > 1) qtyInput.value = value - 1;
});

document.getElementById('increaseQty').addEventListener('click', function () {
  const qtyInput = document.getElementById('quantity');
  let value = parseInt(qtyInput.value, 10);
  qtyInput.value = value + 1;
});