<?php
// FAQ data for buying vegetables and crops.
$faqs = [
    [
        'question' => 'How do I place an order for vegetables or crops?',
        'answer' => 'To place an order, simply visit our website, browse through our available products, and select the vegetables or crops you wish to purchase. After selecting, click "Add to Cart," and proceed to checkout where you can confirm your order and provide shipping details.'
    ],
    [
        'question' => 'What payment methods do you accept?',
        'answer' => 'We accept various payment methods including credit/debit cards, online banking, and payment services such as PayPal. All transactions are secure, and we ensure your payment details are protected.'
    ],
    [
        'question' => 'Do you offer home delivery?',
        'answer' => 'Yes! We offer home delivery for all orders. Once your order is confirmed, we will ship it to the address provided during checkout. Delivery times vary based on your location, but we strive to deliver as quickly as possible.'
    ],
    [
        'question' => 'Are the vegetables and crops fresh?',
        'answer' => 'Yes, we ensure that all our vegetables and crops are fresh and of the highest quality. We work directly with local farmers and use efficient supply chain methods to guarantee freshness from farm to table.'
    ],
    [
        'question' => 'Can I choose specific vegetables or crops?',
        'answer' => 'Absolutely! You can choose from a wide range of vegetables and crops. We list the available items on our website, and you can pick and choose based on your preferences. If youre looking for something specific that’s not listed, feel free to contact us, and well try to source it for you.'
    ],
    [
        'question' => 'Is there a minimum order amount?',
        'answer' => 'There is no minimum order amount for most items, but certain delivery charges may apply depending on your order size or location. Please check the shipping options during checkout for more details.'
    ],
    [
        'question' => 'Can I cancel or modify my order after placing it?',
        'answer' => 'Once an order is placed, it is processed quickly to ensure fast delivery. However, you can cancel or modify your order within 24 hours. Please contact our customer service team as soon as possible to request any changes.'
    ],
    [
        'question' => 'How do I know if my order has been confirmed?',
        'answer' => 'Once your order is successfully placed, you will receive an email confirmation with details about the products you’ve ordered, your delivery address, and an estimated delivery date. You can also track your order status through your account on our website.'
    ],
    [
        'question' => 'Do you offer organic vegetables?',
        'answer' => 'Yes, we offer a variety of organic vegetables and crops. These are grown without the use of synthetic pesticides or fertilizers, ensuring they are both healthy and environmentally friendly. Look for the "Organic" label on the product pages.'
    ]
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vegetable & Crop Buying FAQ</title>
 <style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  
    color: #333;
}

header {
    background-color: #4CAF50;
    color: white;
    text-align: center;
    padding: 20px;
}

main {
    padding: 20px;
}

h2 {
    font-size: 24px;
    color: #5c9c6e;
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
        <h1>Frequently Asked Questions</h1>
        <p>Everything you need to know about buying vegetables and crops from us</p>
    </header>

    <main>
        <section>
            <div class="faq-container">
                <?php
                // Loop through the FAQs and display each question and answer
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
        <p>&copy; 2024 Vegetable & Crop Market. All rights reserved.</p>
    </footer>
</body>
</html>
