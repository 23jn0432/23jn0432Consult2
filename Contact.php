<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $name = htmlspecialchars(trim($_POST['name']), ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars(trim($_POST['email']), ENT_QUOTES, 'UTF-8');
    $message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES, 'UTF-8');

    // Validate inputs
    if (!empty($name) && filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($message)) {
        // CSV File Handling
        $csvFile = fopen('contacts.csv', 'a');
        if ($csvFile !== false) {
            fputcsv($csvFile, [$name, $email, $message, date('Y-m-d H:i:s')]);
            fclose($csvFile);
            echo "<div id='success-message' class='alert alert-success text-center'>お問い合わせありがとうございました。</div>";
        } else {
            echo "<div class='alert alert-danger text-center'>ファイルエラーが発生しました。</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>正しい情報を入力してください。</div>";
    }
} else {
    echo "<div class='alert alert-warning text-center'>無効なリクエストです。</div>";
}
?>

<!-- Fireworks Animation -->
<div id="fireworks-container"></div>

<!-- Add JavaScript for Fireworks -->
<script>
    if (document.getElementById("success-message")) {
        // Fireworks animation
        function createFirework(x, y) {
            const firework = document.createElement('div');
            firework.classList.add('firework');
            firework.style.left = `${x}px`;
            firework.style.top = `${y}px`;
            document.body.appendChild(firework);

            // Animation
            setTimeout(() => {
                firework.style.transform = 'scale(3)';
                firework.style.opacity = '0';
                firework.style.animation = 'firework-explosion 1s forwards';
            }, 10);

            setTimeout(() => {
                firework.remove();
            }, 1000);
        }

        // Trigger fireworks on successful form submission
        document.getElementById('success-message').addEventListener('click', function() {
            const x = Math.random() * window.innerWidth;
            const y = Math.random() * window.innerHeight;
            createFirework(x, y);
        });
    }

    // Optional: Create a fun firework effect on page load for a festive touch
    document.addEventListener('DOMContentLoaded', function () {
        const x = Math.random() * window.innerWidth;
        const y = Math.random() * window.innerHeight;
        createFirework(x, y);
    });
</script>

<!-- Add CSS for Fireworks Effect -->
<style>
    #fireworks-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
    }

    .firework {
        position: absolute;
        width: 15px;
        height: 15px;
        background-color: #ff5733;
        border-radius: 50%;
        pointer-events: none;
        animation: firework-animation 0.5s ease-out;
    }

    @keyframes firework-animation {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(2.5);
            opacity: 0;
        }
    }

    @keyframes firework-explosion {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        100% {
            transform: scale(5);
            opacity: 0;
        }
    }

    /* Success message style */
    #success-message {
        font-size: 24px;
        padding: 15px;
        margin: 20px auto;
        background-color: #28a745;
        color: white;
        border-radius: 8px;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        text-transform: uppercase;
        animation: successMessageAnimation 2s ease-out;
    }

    #success-message:hover {
        background-color: #218838;
        cursor: pointer;
    }

    @keyframes successMessageAnimation {
        0% {
            opacity: 0;
            transform: translateY(-20px);
        }
        50% {
            opacity: 1;
            transform: translateY(0);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
