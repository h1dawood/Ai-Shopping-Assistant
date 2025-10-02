<?php
header('Content-Type: application/json');

// Your Gemini API Key
define('GEMINI_API_KEY', 'API'); // Replace with your actual API key
define('GEMINI_API_URL', 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent?key=' . GEMINI_API_KEY);

// Mock product database

// --- MOCK PRODUCT DATABASE ---
$products = [
    [
        "title" => "حذاء نايك إير ماكس 90", "brand" => "Nike", "vendor" => "متجر نايك الرسمي",
        "color" => "أسود", "price" => 120, "category" => "أحذية",
        "description" => "حذاء رياضي كلاسيكي ومريح مناسب للحركة اليومية.",
        "image" => "cdn/1.jpg"
    ],
    [
        "title" => "حذاء أديداس ألترا بوست", "brand" => "Adidas", "vendor" => "متجر أديداس",
        "color" => "أبيض", "price" => 180, "category" => "أحذية",
        "description" => "يوفر راحة عالية واستجابة مثالية لكل خطوة أثناء المشي أو الجري.",
        "image" => "cdn/2.webp"
    ],
    [
        "title" => "حذاء بوما آر إس-إكس", "brand" => "Puma", "vendor" => "متجر بوما",
        "color" => "أحمر", "price" => 110, "category" => "أحذية",
        "description" => "تصميم عصري جريء يجمع بين الراحة والأناقة.",
        "image" => "cdn/3.webp"
    ],
    [
        "title" => "حقيبة سبيدي", "brand" => "Louis Vuitton", "vendor" => "متجر لويس فويتون",
        "color" => "بني", "price" => 1000, "category" => "إكسسوارات",
        "description" => "حقيبة فاخرة بتصميم أيقوني، مثالية للاستخدام اليومي والأناقة.",
        "image" => "cdn/4.webp"
    ],
    [
        "title" => "حذاء كونفرس تشاك تايلور", "brand" => "Converse", "vendor" => "متجر كونفرس",
        "color" => "أبيض", "price" => 50, "category" => "أحذية",
        "description" => "حذاء كلاسيكي يناسب جميع الإطلالات، مريح وخفيف الوزن.",
        "image" => "cdn/5.jpg"
    ],
    [
        "title" => "جاكيت جينز ليفايس", "brand" => "Levi's", "vendor" => "متجر ليفايس",
        "color" => "أزرق", "price" => 90, "category" => "ملابس",
        "description" => "جاكيت جينز عصري يمكن تنسيقه مع مختلف الملابس اليومية.",
        "image" => "cdn/6.jpg"
    ],

    [
        "title" => "حذاء نايك اير ماكس 90", "brand" => "Nike", "vendor" => "متجر نايك الرسمي",
        "color" => "أسود", "price" => 120, "category" => "shoes", 
        "description" => "حذاء رياضي كلاسيكي ومريح، مثالي للاستخدام اليومي.",
        "image" => "https://images-cdn.ubuy.com.eg/6350b9c73f412c32af6c3d26-nike-air-max-97-man-42-44-45-black-red.jpg"
    ],
    [
        "title" => "اديداس الترا بوست", "brand" => "Adidas", "vendor" => "متجر أديداس",
        "color" => "أبيض", "price" => 180, "category" => "shoes",
        "description" => "يوفر راحة فائقة واستجابة للطاقة مع كل خطوة.",
        "image" => "https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/775ac6a992b1401685291076ba7a904b_9366/Ultraboost_1.0_Shoes_White_HQ4207_01_standard.jpg"
    ],
    [
        "title" => "بوما آر إس-إكس", "brand" => "Puma", "vendor" => "متجر بوما",
        "color" => "أحمر", "price" => 110, "category" => "shoes",
        "description" => "تصميم عصري وجريء يجمع بين الأناقة والراحة.",
        "image" => "https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_750,h_750/global/373178/01/sv01/fnd/PNA/fmt/png/RS-X%C2%B3-Chinese-New-Year-Men's-Sneakers"
    ],
    [
        "title" => "حقيبة لويس فويتون سبيدي", "brand" => "Louis Vuitton", "vendor" => "لويس فويتون",
        "color" => "بني", "price" => 1000, "category" => "accessories",
        "description" => "حقيبة يد فاخرة وأيقونية، رمز للأناقة الخالدة.",
        "image" => "https://us.louisvuitton.com/images/is/image/lv/1/PP_VP_L/louis-vuitton-speedy-bandouliere-25--M46977_PM1_Side%20view.jpg"
    ],
    [
        "title" => "كونفرس تشاك تايلور", "brand" => "Converse", "vendor" => "متجر كونفرس",
        "color" => "أبيض", "price" => 50, "category" => "shoes",
        "description" => "حذاء قماشي كلاسيكي لا يخرج عن الموضة أبدًا.",
        "image" => "cdn/conv.jpg"
    ],
    [
        "title" => "جاكيت ليفايز الدينيم", "brand" => "Levi's", "vendor" => "ليفايز الرسمي",
        "color" => "أزرق", "price" => 90, "category" => "clothing",
        "description" => "جاكيت جينز أصلي بتصميم متين وعصري لكل الأوقات.",
        "image" => "https://lsco.scene7.com/is/image/lsco/723340134-front-pdp?fmt=jpeg&qlt=70,1&op_sharpen=0&resMode=sharp2&op_usm=0.8,1,10,0&fit=crop,0&wid=810&hei=1080"
    ]
];


$input = json_decode(file_get_contents("php://input"), true);
$query = $input["query"] ?? "";

if (empty($query)) {
    echo json_encode(["products" => $products, "error" => "No query provided"]);
    exit;
}

$filters = extractFiltersWithGemini($query);
$filteredProducts = filterProducts($products, $filters);

echo json_encode([
    "products" => array_values($filteredProducts),
    "filters" => $filters,
    "query" => $query
], JSON_UNESCAPED_UNICODE);

function extractFiltersWithGemini($query) {
    $prompt = "Given the user query: \"$query\", extract product filters.
Return ONLY a valid JSON object. Do not add explanations or markdown.
The JSON should have these fields (use null if a field is not mentioned):
{
    \"brands\": [\"Brand1\", \"Brand2\"] or null,
    \"colors\": [\"Color1\", \"Color2\"] or null,
    \"categories\": [\"أحذية\", \"إكسسوارات\", \"ملابس\"] or null,
    \"minPrice\": number or null,
    \"maxPrice\": number or null
}

IMPORTANT: 
- Always return colors in ARABIC: أبيض, أسود, أحمر, أزرق, بني, أخضر, أصفر
- Always return categories in ARABIC: أحذية, إكسسوارات, ملابس

Examples:
\"حذاء نايك أسود\" -> {\"brands\":[\"Nike\"],\"colors\":[\"أسود\"],\"categories\":[\"أحذية\"],\"minPrice\":null,\"maxPrice\":null}
\"حقيبة حمراء بأقل من 300\" -> {\"brands\":null,\"colors\":[\"أحمر\"],\"categories\":[\"إكسسوارات\"],\"minPrice\":null,\"maxPrice\":300}
\"اديداس أبيض\" -> {\"brands\":[\"Adidas\"],\"colors\":[\"أبيض\"],\"categories\":null,\"minPrice\":null,\"maxPrice\":null}
\"ملابس فوق 50\" -> {\"brands\":null,\"colors\":null,\"categories\":[\"ملابس\"],\"minPrice\":50,\"maxPrice\":null}
\"حذاء ابيض\" -> {\"brands\":null,\"colors\":[\"أبيض\"],\"categories\":[\"أحذية\"],\"minPrice\":null,\"maxPrice\":null}

Return ONLY the raw JSON object.";

    $requestBody = [
        "contents" => [["parts" => [["text" => $prompt]]]],
        "generationConfig" => ["temperature" => 0.1, "maxOutputTokens" => 250]
    ];

    $ch = curl_init(GEMINI_API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestBody));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
        error_log("Gemini API Error ($httpCode): " . $response);
        return ["error" => "API request failed with code $httpCode"];
    }

    $responseData = json_decode($response, true);
    $aiText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? '';

    $aiText = preg_replace('/```json\s*|\s*```/', '', $aiText);
    $aiText = trim($aiText);

    $filters = json_decode($aiText, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON decode error: " . json_last_error_msg() . " | Raw AI Response: " . $aiText);
        return ["error" => "Failed to parse AI response as JSON"];
    }

    // Normalize colors and categories to Arabic
    $filters = normalizeFilters($filters);

    return $filters;
}

function normalizeFilters($filters) {
    // Color translation map
    $colorMap = [
        'white' => 'أبيض',
        'black' => 'أسود',
        'red' => 'أحمر',
        'blue' => 'أزرق',
        'brown' => 'بني',
        'green' => 'أخضر',
        'yellow' => 'أصفر',
        'ابيض' => 'أبيض',  // Handle different spellings
        'اسود' => 'أسود',
        'احمر' => 'أحمر',
        'ازرق' => 'أزرق'
    ];

    // Category translation map
    $categoryMap = [
        'shoes' => 'أحذية',
        'accessories' => 'إكسسوارات',
        'clothing' => 'ملابس',
        'احذية' => 'أحذية',
        'اكسسوارات' => 'إكسسوارات'
    ];

    // Normalize colors
    if (!empty($filters['colors'])) {
        $filters['colors'] = array_map(function($color) use ($colorMap) {
            $colorLower = mb_strtolower(trim($color), 'UTF-8');
            return $colorMap[$colorLower] ?? $color;
        }, $filters['colors']);
    }

    // Normalize categories
    if (!empty($filters['categories'])) {
        $filters['categories'] = array_map(function($category) use ($categoryMap) {
            $categoryLower = mb_strtolower(trim($category), 'UTF-8');
            return $categoryMap[$categoryLower] ?? $category;
        }, $filters['categories']);
    }

    return $filters;
}

function filterProducts($allProducts, $filters) {
    if (isset($filters['error'])) {
        return $allProducts;
    }

    return array_filter($allProducts, function($product) use ($filters) {
        $brandMatch = empty($filters['brands']) || in_arrayi($product['brand'], $filters['brands']);
        $colorMatch = empty($filters['colors']) || in_arrayi($product['color'], $filters['colors']);
        $categoryMatch = empty($filters['categories']) || in_arrayi($product['category'], $filters['categories']);
        
        $minPriceMatch = !isset($filters['minPrice']) || $product['price'] >= $filters['minPrice'];
        $maxPriceMatch = !isset($filters['maxPrice']) || $product['price'] <= $filters['maxPrice'];

        return $brandMatch && $colorMatch && $categoryMatch && $minPriceMatch && $maxPriceMatch;
    });
}

// Case-insensitive version of in_array for filtering
function in_arrayi($needle, $haystack) {
    foreach ($haystack as $value) {
        if (mb_strtolower($needle, 'UTF-8') === mb_strtolower($value, 'UTF-8') || 
            mb_stripos($value, $needle) !== false || 
            mb_stripos($needle, $value) !== false) {
            return true;
        }
    }
    return false;
}
?>