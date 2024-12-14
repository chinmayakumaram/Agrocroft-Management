<?php
// You can store the questions and answers in an array for dynamic handling.
$faqs = [
    [
        'question' => 'What is Agriculture Management?',
        'answer' => 'Agriculture Management refers to the practice of efficiently managing farm operations, resources, crops, and livestock. It involves making decisions on crop selection, irrigation, pest management, and sustainable farming practices to ensure maximum productivity and profitability.'
    ],
    [
        'question' => 'How can I improve crop yield?',
        'answer' => 'To improve crop yield, consider adopting modern agricultural practices such as precision farming, crop rotation, proper irrigation management, soil fertility testing, and using organic or eco-friendly fertilizers.'
    ],
    [
        'question' => 'What is sustainable farming?',
        'answer' => 'Sustainable farming is an agricultural method that focuses on producing food while conserving resources, maintaining environmental health, and supporting farm profitability over the long term. This includes using eco-friendly practices like reducing chemical use, crop rotation, and protecting natural ecosystems.'
    ],
    [
        'question' => 'How can I manage irrigation efficiently?',
        'answer' => 'Efficient irrigation management involves assessing soil moisture levels, utilizing modern irrigation systems such as drip irrigation, and scheduling irrigation based on weather forecasts. Implementing water-saving technologies and reducing waste is also critical.'
    ],
    [
        'question' => 'What are the benefits of crop rotation?',
        'answer' => 'Crop rotation helps improve soil fertility, reduces pest and disease buildup, prevents soil erosion, and enhances biodiversity. By rotating crops, different nutrients are drawn from the soil, and the risk of monoculture diseases is minimized.'
    ]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agriculture Management FAQ</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

header {
    background-color: #4CAF50;
    color: white;
    text-align: center;
    padding: 10px;
}

main {
    padding: 20px;
}

h2 {
    font-size: 24px;
    color: #4CAF50;
}

.faq-container {
    max-width: 800px;
    margin: 0 auto;
}

.faq-item {
    background-color: white;
    margin: 10px 0;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.faq-question {
    font-size: 18px;
    font-weight: bold;
    margin: 0;
}

.faq-answer {
    font-size: 16px;
    margin-top: 10px;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: fixed;
    width: 100%;
    bottom: 0;
}

    </style>
</head>
<body>
    <header>
        <h1>Agriculture Management FAQ</h1>
        <p>Your go-to guide for effective farming practices</p>
    </header>

    <main>
        <section>
            <h2>Frequently Asked Questions</h2>
            <div class="faq-container">
                <?php
                // Loop through the FAQs and display each one
                foreach ($faqs as $faq) {
                    echo '<div class="faq-item">';
                    echo '<h3 class="faq-question">' . htmlspecialchars($faq['question']) . '</h3>';
                    echo '<p class="faq-answer">' . nl2br(htmlspecialchars($faq['answer'])) . '</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Agriculture Management. All rights reserved.</p>
    </footer>
</body>
</html>
