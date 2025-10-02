<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>مساعد التسوق الذكي</title>
  <meta name="author" content="H1Dawood">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    :root {
      --bg-primary: #212121;
      --bg-secondary: #2f2f2f;
      --bg-tertiary: #171717;
      --text-primary: #ececec;
      --text-secondary: #b4b4b4;
      --accent-primary: #10a37f;
      --accent-hover: #0d8a6a;
      --border-color: #4d4d4f;
      --user-msg-bg: #2f2f2f;
      --bot-msg-bg: transparent;
      --input-bg: #40414f;
      --card-bg: #2a2a2a;
      --shadow: rgba(0, 0, 0, 0.4);
    }

    body {
      font-family: 'Tajawal', -apple-system, BlinkMacSystemFont, sans-serif;
      background: var(--bg-primary);
      color: var(--text-primary);
      overflow: hidden;
      height: 100vh;
    }

    .app-container {
      display: flex;
      height: 100vh;
      position: relative;
    }

    /* Sidebar */
    .sidebar {
      width: 260px;
      background: var(--bg-tertiary);
      border-left: 1px solid var(--border-color);
      display: flex;
      flex-direction: column;
      padding: 12px;
      transition: transform 0.3s ease;
    }

    .new-chat-btn {
      background: transparent;
      border: 1px solid var(--border-color);
      color: var(--text-primary);
      padding: 12px;
      border-radius: 8px;
      cursor: pointer;
      font-family: 'Tajawal', sans-serif;
      font-size: 14px;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.2s;
      margin-bottom: 12px;
    }

    .new-chat-btn:hover {
      background: var(--bg-secondary);
    }

    .chat-history {
      flex: 1;
      overflow-y: auto;
      scrollbar-width: thin;
      scrollbar-color: var(--border-color) transparent;
    }

    .chat-history::-webkit-scrollbar {
      width: 6px;
    }

    .chat-history::-webkit-scrollbar-thumb {
      background: var(--border-color);
      border-radius: 3px;
    }

    .sidebar-footer {
      padding-top: 12px;
      border-top: 1px solid var(--border-color);
      font-size: 13px;
      color: var(--text-secondary);
    }

    /* Main Chat Area */
    .main-content {
      flex: 1;
      display: flex;
      flex-direction: column;
      background: var(--bg-primary);
      position: relative;
    }

    .chat-header {
      padding: 16px 20px;
      border-bottom: 1px solid var(--border-color);
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--bg-tertiary);
    }

    .chat-title {
      font-size: 16px;
      font-weight: 600;
      color: var(--text-primary);
    }

    .menu-toggle {
      display: none;
      background: transparent;
      border: none;
      color: var(--text-primary);
      font-size: 24px;
      cursor: pointer;
      padding: 8px;
    }

    .messages-container {
      flex: 1;
      overflow-y: auto;
      padding: 20px;
      scrollbar-width: thin;
      scrollbar-color: var(--border-color) transparent;
    }

    .messages-container::-webkit-scrollbar {
      width: 8px;
    }

    .messages-container::-webkit-scrollbar-thumb {
      background: var(--border-color);
      border-radius: 4px;
    }

    .message-wrapper {
      max-width: 1000px;
      margin: 0 auto 24px;
      opacity: 0;
      transform: translateY(20px);
    }

    .message {
      display: flex;
      gap: 16px;
      padding: 16px;
      border-radius: 8px;
    }

    .message.user {
      background: var(--user-msg-bg);
    }

    .message.bot {
      background: var(--bot-msg-bg);
    }

    .message-avatar {
      width: 32px;
      height: 32px;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      flex-shrink: 0;
    }

    .user .message-avatar {
      background: #5436da;
    }

    .bot .message-avatar {
      background: var(--accent-primary);
    }

    .message-content {
      flex: 1;
      line-height: 1.7;
      font-size: 15px;
    }

    .filters-display {
      background: var(--bg-secondary);
      padding: 12px;
      border-radius: 8px;
      margin-top: 12px;
      font-size: 13px;
      border-right: 3px solid var(--accent-primary);
    }

    .filter-tag {
      display: inline-block;
      background: var(--bg-tertiary);
      padding: 4px 10px;
      border-radius: 12px;
      margin: 4px 4px 4px 0;
      font-size: 12px;
    }

    .suggestions {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 12px;
    }

    .suggestion-chip {
      background: var(--bg-secondary);
      border: 1px solid var(--border-color);
      padding: 8px 14px;
      border-radius: 16px;
      font-size: 13px;
      cursor: pointer;
      transition: all 0.2s;
    }

    .suggestion-chip:hover {
      background: var(--input-bg);
      border-color: var(--accent-primary);
    }

    /* Products Grid */
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
      gap: 16px;
      margin-top: 16px;
      opacity: 0;
    }

    .product-card {
      background: var(--card-bg);
      border: 1px solid var(--border-color);
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s;
      cursor: pointer;
      opacity: 0;
      transform: translateY(30px);
    }

    .product-card:hover {
      transform: translateY(-4px);
      border-color: var(--accent-primary);
      box-shadow: 0 8px 24px var(--shadow);
    }

    .product-image {
      width: 100%;
      aspect-ratio: 1;
      object-fit: cover;
      background: var(--bg-secondary);
    }

    .product-info {
      padding: 14px;
    }

    .product-title {
      font-size: 15px;
      font-weight: 600;
      color: var(--text-primary);
      margin-bottom: 6px;
    }

    .product-vendor {
      font-size: 12px;
      color: var(--text-secondary);
      margin-bottom: 8px;
    }

    .product-description {
      font-size: 13px;
      color: var(--text-secondary);
      line-height: 1.5;
      margin-bottom: 10px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .product-price {
      font-size: 18px;
      font-weight: 700;
      color: var(--accent-primary);
      text-align: left;
    }

    /* Input Area */
    .input-area {
      border-top: 1px solid var(--border-color);
      padding: 20px;
      background: var(--bg-primary);
    }

    .input-container {
      max-width: 1000px;
      margin: 0 auto;
      position: relative;
    }

    .input-wrapper {
      display: flex;
      align-items: center;
      background: var(--input-bg);
      border-radius: 12px;
      padding: 12px 16px;
      gap: 12px;
      border: 1px solid transparent;
      transition: all 0.2s;
    }

    .input-wrapper:focus-within {
      border-color: var(--accent-primary);
      box-shadow: 0 0 0 3px rgba(16, 163, 127, 0.1);
    }

    #userInput {
      flex: 1;
      background: transparent;
      border: none;
      color: var(--text-primary);
      font-size: 15px;
      font-family: 'Tajawal', sans-serif;
      outline: none;
      resize: none;
      max-height: 200px;
    }

    #userInput::placeholder {
      color: var(--text-secondary);
    }

    .send-btn {
      width: 36px;
      height: 36px;
      border-radius: 8px;
      background: var(--accent-primary);
      border: none;
      color: white;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s;
      font-size: 20px;
    }

    .send-btn:hover:not(:disabled) {
      background: var(--accent-hover);
    }

    .send-btn:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }

    .loading-dots {
      display: inline-flex;
      gap: 4px;
      align-items: center;
    }

    .loading-dots span {
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: var(--text-secondary);
      animation: bounce 1.4s infinite ease-in-out both;
    }

    .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
    .loading-dots span:nth-child(2) { animation-delay: -0.16s; }

    @keyframes bounce {
      0%, 80%, 100% { transform: scale(0); }
      40% { transform: scale(1); }
    }

    .error-message {
      background: rgba(239, 68, 68, 0.1);
      border: 1px solid rgba(239, 68, 68, 0.3);
      color: #f87171;
      padding: 12px;
      border-radius: 8px;
      margin-top: 12px;
      font-size: 14px;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        left: 0;
        top: 0;
        height: 100vh;
        z-index: 1000;
        transform: translateX(-100%);
        box-shadow: 2px 0 8px var(--shadow);
      }

      .sidebar.open {
        transform: translateX(0);
      }

      .menu-toggle {
        display: block;
      }

      .products-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="app-container">


    <!-- Main Content -->
    <main class="main-content">
      <header class="chat-header">
        <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <div class="chat-title">مساعد التسوق الذكي</div>
        <div></div>
      </header>

      <div class="messages-container" id="messagesContainer">
        <div class="message-wrapper">
          <div class="message bot">
            <div class="message-avatar">🤖</div>
            <div class="message-content">
              <div>مرحباً! أنا مساعدك الذكي للتسوق. يمكنني مساعدتك في العثور على المنتجات المثالية.</div>
<?php
$products = [
    ["title"=>"حذاء نايك إير ماكس 90", "brand"=>"Nike", "vendor"=>"متجر نايك الرسمي", "color"=>"أسود", "price"=>120, "category"=>"أحذية", "description"=>"حذاء رياضي كلاسيكي ومريح مناسب للحركة اليومية.", "image"=>"cdn/1.jpg"],
    ["title"=>"حذاء أديداس ألترا بوست", "brand"=>"Adidas", "vendor"=>"متجر أديداس", "color"=>"أبيض", "price"=>180, "category"=>"أحذية", "description"=>"يوفر راحة عالية واستجابة مثالية لكل خطوة أثناء المشي أو الجري.", "image"=>"cdn/2.webp"],
    ["title"=>"حذاء بوما آر إس-إكس", "brand"=>"Puma", "vendor"=>"متجر بوما", "color"=>"أحمر", "price"=>110, "category"=>"أحذية", "description"=>"تصميم عصري جريء يجمع بين الراحة والأناقة.", "image"=>"cdn/3.webp"],
    ["title"=>"حقيبة سبيدي", "brand"=>"Louis Vuitton", "vendor"=>"متجر لويس فويتون", "color"=>"بني", "price"=>1000, "category"=>"إكسسوارات", "description"=>"حقيبة فاخرة بتصميم أيقوني، مثالية للاستخدام اليومي والأناقة.", "image"=>"cdn/4.webp"],
    ["title"=>"حذاء كونفرس تشاك تايلور", "brand"=>"Converse", "vendor"=>"متجر كونفرس", "color"=>"أبيض", "price"=>50, "category"=>"أحذية", "description"=>"حذاء كلاسيكي يناسب جميع الإطلالات، مريح وخفيف الوزن.", "image"=>"cdn/5.jpg"],
    ["title"=>"جاكيت جينز ليفايس", "brand"=>"Levi's", "vendor"=>"متجر ليفايس", "color"=>"أزرق", "price"=>90, "category"=>"ملابس", "description"=>"جاكيت جينز عصري يمكن تنسيقه مع مختلف الملابس اليومية.", "image"=>"cdn/6.jpg"],
];

shuffle($products); // نخلط المنتجات عشان نطلع عشوائي
$suggestions = array_slice($products, 0, 4); // ناخد 4 بس

echo '<div class="suggestions">';
foreach ($suggestions as $p) {
    // نص الاقتراح: "براند + لون" أو "منتج + سعر"
    $text = $p['brand'] . " " . $p['color'];
    if (rand(0,1)) {
        $text = $p['title'] . " بأقل من " . ($p['price'] + 50);
    }
    
    echo '<span class="suggestion-chip" onclick="quickSearch(\'' . $text . '\')">' . $text . '</span>';
}
echo '</div>';
?>
            </div>
          </div>
        </div>
      </div>

      <div class="input-area">
        <div class="input-container">
          <div class="input-wrapper">
            <textarea 
              id="userInput" 
              placeholder="اطلب منتجاً... (مثال: حذاء نايك أسود)"
              rows="1"
              onkeypress="handleKeyPress(event)"
              oninput="autoResize(this)"
            ></textarea>
            <button class="send-btn" id="sendBtn" onclick="sendMessage()">
              <span>↑</span>
            </button>
          </div>
        </div>
      </div>
    </main>
  </div>

  <script>
    // Initialize GSAP animations
    gsap.from('.chat-header', { duration: 0.5, y: -20, opacity: 0, ease: 'power2.out' });
    gsap.from('.sidebar', { duration: 0.5, x: -50, opacity: 0, ease: 'power2.out', delay: 0.1 });
    gsap.from('.input-area', { duration: 0.5, y: 20, opacity: 0, ease: 'power2.out', delay: 0.2 });

    // Animate initial message
    gsap.to('.message-wrapper', {
      duration: 0.6,
      opacity: 1,
      y: 0,
      ease: 'power2.out',
      delay: 0.3
    });

    function autoResize(textarea) {
      textarea.style.height = 'auto';
      textarea.style.height = Math.min(textarea.scrollHeight, 200) + 'px';
    }

    function handleKeyPress(event) {
      if (event.key === 'Enter' && !event.shiftKey) {
        event.preventDefault();
        sendMessage();
      }
    }

    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('open');
    }

    function newChat() {
      location.reload();
    }

    function quickSearch(query) {
      document.getElementById('userInput').value = query;
      sendMessage();
    }

    async function sendMessage() {
      const input = document.getElementById('userInput');
      const msg = input.value.trim();
      if (!msg) return;

      const sendBtn = document.getElementById('sendBtn');
      const messagesContainer = document.getElementById('messagesContainer');

      sendBtn.disabled = true;
      sendBtn.innerHTML = '<div class="loading-dots"><span></span><span></span><span></span></div>';

      // Add user message with animation
      const userMsgWrapper = document.createElement('div');
      userMsgWrapper.className = 'message-wrapper';
      userMsgWrapper.innerHTML = `
        <div class="message user">
          <div class="message-avatar">👤</div>
          <div class="message-content">${escapeHtml(msg)}</div>
        </div>
      `;
      messagesContainer.appendChild(userMsgWrapper);
      
      gsap.fromTo(userMsgWrapper, 
        { opacity: 0, y: 20 },
        { duration: 0.4, opacity: 1, y: 0, ease: 'power2.out' }
      );

      input.value = '';
      input.style.height = 'auto';
      messagesContainer.scrollTop = messagesContainer.scrollHeight;

      try {
        const res = await fetch('server.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ query: msg })
        });

        if (!res.ok) throw new Error('خطأ في الخادم: ' + res.status);
        const data = await res.json();

        // Add bot response with animation
        const botMsgWrapper = document.createElement('div');
        botMsgWrapper.className = 'message-wrapper';
        
        let filterText = '';
        if (data.filters && !data.filters.error) {
          let tags = [];
          if (data.filters.brands) tags.push(...data.filters.brands.map(b => `<span class="filter-tag">🏷️ ${b}</span>`));
          if (data.filters.colors) tags.push(...data.filters.colors.map(c => `<span class="filter-tag">🎨 ${c}</span>`));
          if (data.filters.categories) tags.push(...data.filters.categories.map(c => `<span class="filter-tag">📦 ${c}</span>`));
          if (data.filters.minPrice) tags.push(`<span class="filter-tag">💰 من ${data.filters.minPrice}$</span>`);
          if (data.filters.maxPrice) tags.push(`<span class="filter-tag">💰 إلى ${data.filters.maxPrice}$</span>`);
          
          if (tags.length > 0) {
            filterText = `<div class="filters-display"><strong>الفلاتر المطبقة:</strong><br>${tags.join(' ')}</div>`;
          }
        }

        botMsgWrapper.innerHTML = `
          <div class="message bot">
            <div class="message-avatar">🤖</div>
            <div class="message-content">
              <div>عثرت على <strong>${data.products.length}</strong> ${data.products.length === 1 ? 'منتج' : 'منتجات'} 🎉</div>
              ${filterText}
              <div class="products-grid" id="productsGrid"></div>
            </div>
          </div>
        `;
        messagesContainer.appendChild(botMsgWrapper);

        gsap.fromTo(botMsgWrapper,
          { opacity: 0, y: 20 },
          { duration: 0.4, opacity: 1, y: 0, ease: 'power2.out' }
        );

        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Display products with stagger animation
        setTimeout(() => displayProducts(data.products, botMsgWrapper.querySelector('#productsGrid')), 200);

      } catch (error) {
        console.error('Error:', error);
        const errorMsgWrapper = document.createElement('div');
        errorMsgWrapper.className = 'message-wrapper';
        errorMsgWrapper.innerHTML = `
          <div class="message bot">
            <div class="message-avatar">🤖</div>
            <div class="message-content">
              <div class="error-message">
                ❌ عذراً، حدث خطأ ما. يرجى المحاولة مرة أخرى.
                <br><small>${error.message}</small>
              </div>
            </div>
          </div>
        `;
        messagesContainer.appendChild(errorMsgWrapper);
        gsap.fromTo(errorMsgWrapper,
          { opacity: 0, y: 20 },
          { duration: 0.4, opacity: 1, y: 0, ease: 'power2.out' }
        );
      } finally {
        sendBtn.disabled = false;
        sendBtn.innerHTML = '<span>↑</span>';
      }
    }

    function displayProducts(products, container) {
      if (!products || products.length === 0) {
        container.innerHTML = '<div style="text-align: center; padding: 20px; color: var(--text-secondary);">لم يتم العثور على منتجات 😔</div>';
        return;
      }

      gsap.to(container, { duration: 0.3, opacity: 1 });

      products.forEach((product, index) => {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.innerHTML = `
          <img class="product-image" src="${escapeHtml(product.image)}" alt="${escapeHtml(product.title)}" loading="lazy">
          <div class="product-info">
            <div class="product-title">${escapeHtml(product.title)}</div>
            <div class="product-vendor">${escapeHtml(product.vendor)}</div>
            <div class="product-description">${escapeHtml(product.description)}</div>
            <div class="product-price">${product.price}$</div>
          </div>
        `;
        container.appendChild(card);

        // Animate each card with stagger
        gsap.fromTo(card,
          { opacity: 0, y: 30, scale: 0.95 },
          { 
            duration: 0.5, 
            opacity: 1, 
            y: 0, 
            scale: 1,
            ease: 'power2.out',
            delay: index * 0.08
          }
        );
      });
    }

    function escapeHtml(text) {
      if (typeof text !== 'string') return '';
      const div = document.createElement('div');
      div.textContent = text;
      return div.innerHTML;
    }

    // Handle textarea auto-resize
    document.getElementById('userInput').addEventListener('input', function() {
      this.style.height = 'auto';
      this.style.height = Math.min(this.scrollHeight, 200) + 'px';
    });
  </script>
</body>
</html>