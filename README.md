# 🧠 Gemini AI Shopping Assistant (PHP)

[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)
![Project Views](https://h1dawood.com/github/view_counter.php?project=Ai-Shopping-Assistant&label=views&color=blue&labelColor=555&logo=eye)
An intelligent shopping assistant powered by Google's Gemini AI and PHP. This application uses natural language processing to understand user queries in Arabic and dynamically filter products from a local catalog.

The entire application in a tow files  `index.php` , `server.php` file, making it incredibly simple to set up and run.

## ✨ Key Features

*   **Natural Language Processing in Arabic:** Leverages the Gemini 2.0 Flash model to understand product-related queries.
*   **Dynamic Filtering:** Extracts filters for brands, colors, categories, and price ranges directly from conversational text.
*   **Zero Dependencies (PHP-only):** No need for Composer or external PHP libraries. It runs on standard PHP with the cURL extension.
*   **Conversational UI:** A modern, responsive chat interface for an intuitive and engaging user experience.
*   **Instant Product Updates:** The displayed products update in real-time based on the AI's understanding of the user's request.
*   **Engaging Animations:** Utilizes the GSAP library (via CDN) for smooth and professional user interface animations.

## 🛠️ Tech Stack

*   **Backend:** PHP (using the built-in cURL extension)
*   **AI Model:** Google Gemini 2.0 Flash
*   **Frontend:** HTML, CSS, JavaScript (no frameworks)
*   **Animations:** GSAP (GreenSock Animation Platform)

## 🚀 Getting Started

To get a local copy up and running, follow these simple steps.

### Prerequisites

Before you begin, ensure you have the following installed and configured:

1.  **PHP:** Version 7.4 or higher.
2.  **Git:** To clone the repository.
3.  **PHP cURL Extension:** This is required to make API calls.
    *   To check if it's enabled, run `php -m | grep curl` in your terminal. If you see `curl`, you're all set.
    *   If not, you may need to enable it in your `php.ini` file by uncommenting the line `extension=curl`.
4.  **Google Gemini API Key:**
    *   You can obtain a free API key from **[Google AI Studio](https://ai.google.dev/)**.

### Installation & Configuration

1.  **Clone the repository:**
    ```sh
    git clone https://github.com/h1dawood/Ai-Shopping-Assistant.git
    ```

2.  **Navigate to the project directory:**
    ```sh
    cd Ai-Shopping-Assistant
    ```

3.  **Configure Your API Key:**
    *   Open the `index.php` file in your favorite code editor.
    *   Find the following line (around line 5):
      ```php
      define('GEMINI_API_KEY', 'API'); // Replace with your actual API key
      ```
    *   Replace the placeholder key with your actual Gemini API key.

4.  **Add Product Images:**
    *   Create a new folder named `cdn` in the root of your project directory.
    *   Place your product images inside this `cdn` folder. Make sure the image filenames match those specified in the `$products` array within `index.php` (e.g., `1.jpg`, `2.webp`, etc.).

### Running the Application

The easiest way to run this project is with PHP's built-in web server.

1.  **Start the server:**
    *   Open your terminal in the project's root directory.
    *   Run the following command:
      ```sh
      php -S localhost:8000
      ```

2.  **View the application:**
    *   Open your web browser and navigate to:
      **[http://localhost:8000](http://localhost:8000)**

That's it! You can now interact with your AI-powered shopping assistant.

## 🤖 How It Works

The application's logic flow is straightforward:

1.  **User Input:** A user types a search query in natural Arabic (e.g., "حذاء نايك أسود بأقل من 150" - "Black Nike shoe for less than 150").
2.  **Frontend Fetch:** The JavaScript frontend sends this query to the backend (the same `index.php` file) via a `fetch` request.
3.  **API Call to Gemini:** The PHP backend constructs a detailed prompt, instructing the Gemini model to analyze the text and return a structured JSON object containing any identified filters (brand, color, etc.).
4.  **AI-Powered Filter Extraction:** The Gemini API processes the request and sends back the JSON object.
5.  **Product Filtering:** The PHP script parses the JSON from Gemini and uses it to filter the hardcoded `$products` array.
6.  **Display Results:** The filtered list of products is sent back to the frontend as a JSON response, which then dynamically renders the product cards on the screen.

## 🤝 Contributing

Contributions, issues, and feature requests are welcome!

1.  Fork the Project
2.  Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3.  Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4.  Push to the Branch (`git push origin feature/AmazingFeature`)
5.  Open a Pull Request

## 📜 License

This project is licensed under the MIT License. See the `LICENSE` file for more details.

## 🙏 Acknowledgments

*   **Google** for the incredible Gemini API.
*   **GreenSock** for the powerful GSAP animation library.
